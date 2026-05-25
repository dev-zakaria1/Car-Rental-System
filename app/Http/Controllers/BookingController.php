<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\booking;
use App\Models\car;
use App\Models\location;
use App\Models\payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    private function clearBookingSession()
    {
        session()->forget(['clientSecret', 'bookingId', 'expiresAt']);
    }
    public function checkPendingBooking()
    {
        $CarId = Auth::id();
        $exist = booking::where('status', 'pending')->where('user_id', $CarId)->exists();
        return $exist;
    }
    public function create(car $car)
    {
        if ($this->checkPendingBooking()) {
            return redirect()->route('booking.show')->with('error', __('you have to pay or cancel your last booking'));
        }
        $locations = location::all();
        return view('listing.rent', compact('car', 'locations'));
    }
    public function show()
    {
        $userId = Auth::id();
        $bookings = booking::latest()->where('user_id', $userId)->paginate(6);
        return view('booking.show', compact('bookings'));
    }
    public function price(StoreBookingRequest $request)
    {
        $car_id = $request->car_id;
        $car = car::findOrFail($car_id);
        $start = Carbon::parse($request->pickup_datetime);
        $end = Carbon::parse($request->dropoff_datetime);
        $hours = $start->diffInHours($end);
        return $hours * $car->hour_rate;
    }
    public function checkDateBooking($carId, $pickup, $dropoff)
    {
        $exist = booking::where('car_id', $carId)->where(function ($q) {
            $q->whereIn('status', ['paid', 'confirmed'])
                ->orWhere(function ($sub) {
                    $sub->where('status', 'pending')
                        ->where('created_at', '>=', now()->subMinutes(30));
                });
        })
            ->where(function ($query) use ($pickup, $dropoff) {
                $query->whereBetween('pickup_datetime', [$pickup, $dropoff])
                    ->orwhereBetween('dropoff_datetime', [$pickup, $dropoff])
                    ->orwhere(function ($q) use ($dropoff, $pickup) {
                        $q->where('pickup_datetime', '<=', $pickup)
                            ->where('dropoff_datetime', '>=', $dropoff);
                    });
            })->exists();

        return $exist;
    }
    public function createBooking(StoreBookingRequest $requestBooking, $amount)
    {
        $booking = new Booking();
        $booking->fill($requestBooking->validated());
        $booking->total_price = $amount;
        $booking->user_id = Auth::id();
        $booking->save();
        return $booking;
    }

    public function store(StoreBookingRequest $requestBooking, StorePaymentRequest $requestPayment)
    {
        try {
            if ($this->checkPendingBooking()) {
                return redirect()->route('booking.show')->with('error', __('you have to pay or cancel your last booking'));
            }
            $amount = $this->price($requestBooking);
            if ($amount == 0) {
                return redirect()->route('listing.index')->with('error', __('there is wrong ,please contact us'));
            }
            //check if there is booking have same date
            if ($this->checkDateBooking($requestBooking->car_id, $requestBooking->pickup_datetime, $requestBooking->dropoff_datetime)) {
                return redirect()->route('listing.index')->with('error', __('This car is already booked or payment is in progress.'));
            }
            $data = DB::transaction(function () use ($requestBooking, $requestPayment, $amount) {
                // create booking 
                $booking = $this->createBooking($requestBooking, $amount);
                $expiresAt = $booking->created_at->addMinutes(30)->timestamp;
                // Order Api Data for payment
                $secretKey = config('services.stripe.secret');
                $response = Http::withToken($secretKey)
                    ->asForm()
                    ->post('https://api.stripe.com/v1/payment_intents', [
                        'amount'   => (int)($amount * 100),
                        'currency' => 'eur',
                        'metadata' => ['booking_id' => $booking->id]
                    ]);
                // If The Request is Successful
                if ($response->successful()) {
                    // Reception Api Data
                    $stripeData = $response->json();
                    // create payment by response of the order 
                    $payment = Payment::create([
                        'booking_id'      => $booking->id,
                        'amount'          => $amount,
                        'currency'        => strtoupper($stripeData['currency']),
                        'method'          => $requestPayment->method ?? 'card',
                        'status'          => 'pending',
                        'transaction_ref' => $stripeData['id'],
                    ]);

                    // return array data 
                    return [
                        'booking_id' => $booking->id,
                        'client_secret' => $stripeData['client_secret'],
                        'expiresAt' => $expiresAt,
                    ];
                }
                // 
                throw new \Exception($response->json()['error']['message'] ?? 'Stripe Error');
            });

            //view page payment
            session([
                'clientSecret' => $data['client_secret'],
                'bookingId'    => $data['booking_id'],
                'expiresAt'    => $data['expiresAt']
            ]);
            return redirect()->route('booking.checkout');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function cancelExpired($id)
    {
        $this->clearBookingSession();
        $booking = booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($booking) {
            $booking->update(['status' => 'cancelled']);
            $booking->payment()->where('status', 'pending')->update(['status' => 'failed']);
            if (request()->expectsJson()) {
                return response()->json(['status' => 'success']);
            }
            return redirect()->route('listing.index')->with('success', 'Booking cancelled.');
        }
    }

    public function checkout()
    {
        $clientSecret = session('clientSecret');
        $bookingId = session('bookingId');
        $expiresAt = session('expiresAt');
        if (!$clientSecret || !$bookingId || !$expiresAt) {
            return redirect()->route('listing.index')->with('error', __('Invalid access to checkout.'));
        }
        $booking = Booking::findOrFail($bookingId);
        return view('payment.checkout', compact('clientSecret', 'booking', 'bookingId', 'expiresAt'));
    }
    public function successPament()
    {
        $this->clearBookingSession();
        return view('payment.success');
    }
}
