<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Models\booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', booking::class);
        $bookings = booking::paginate(10);
        return view('dashboard.booking.index', compact('bookings'));
    }
    public function update(UpdateBookingRequest $request, booking $booking)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($booking, $validated) {
            if ($booking->payment && $validated['status'] == 'cancelled') {
                if ($booking->payment->status == 'paid') {
                    $booking->payment->update(['status' => 'refunded']);
                } elseif ($booking->payment->status == 'pending') {
                    $booking->payment->update([
                        'status' => 'failed',
                    ]);
                }
            }
            $booking->update($validated);
        });
        return redirect()->route('booking.index')->with('success', 'Status is updated');
    }
}
