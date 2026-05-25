<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {

    $expiredBookings = booking::where('status', 'pending')
        ->where('created_at', '<', now()->subMinutes(30))
        ->get();

    foreach ($expiredBookings as $booking) {
        $booking->update(['status' => 'cancelled']);

        // تحديث سجل الدفع المرتبط
        payment::where('booking_id', $booking->id)
            ->where('status', 'pending')
            ->update(['status' => 'failed']);
    }
})->everyFiveMinutes();

Schedule::command('app:start-bookings')->everyMinute();
