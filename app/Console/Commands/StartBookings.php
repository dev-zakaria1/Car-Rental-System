<?php

namespace App\Console\Commands;

use App\Models\booking;
use Illuminate\Console\Command;

class StartBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        $updatedCount = booking::where('status', 'confirmed')
            ->where('pickup_datetime', '<=', $now)
            ->update(['status' => 'in_progress']);
        $updatedBook=booking::where('status', 'in_progress')
            ->where('dropoff_datetime', '<=', $now)
            ->update(['status' => 'completed']);
    }
}
