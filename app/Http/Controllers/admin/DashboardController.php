<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $latestBookings = booking::latest()->take(5)->get();
        $salesCount = Booking::count();
        $totalEarnings = payment::sum('amount');
        $visitorsCount = User::count();
        $ordersCount = Booking::where('status', 'pending')->count();
        return view('dashboard.index', compact(
            'latestBookings',
            'salesCount',
            'totalEarnings',
            'visitorsCount',
            'ordersCount'
        ));
    }
}
