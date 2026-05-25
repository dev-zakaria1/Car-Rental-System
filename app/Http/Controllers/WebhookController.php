<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function handle(Request $request)
    {
        $payload = $request->all();
        $endpoint_secret = config('services.stripe.webhook_secret');

        Log::info('Stripe Webhook Received', ['payload' => $payload]);

        if (isset($payload['type']) && $payload['type'] === 'payment_intent.succeeded') {
            $intent = $payload['data']['object'];
            $stripeId = $intent['id'];

            $payment = payment::where('transaction_ref', $stripeId)->first();

            if ($payment) {
                $payment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                // تحديث حالة الحجز إذا كان عندك علاقة بين الحجز والدفع
                if ($payment->booking) {
                    $payment->booking->update(['status' => 'confirmed']);
                }

                return response()->json(['status' => 'Payment updated'], 200);
            }
        }

        return response()->json(['status' => 'Received'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
