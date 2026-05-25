<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\car_category;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = car::with('car_category')->where('status', 'available')->paginate(6);
        return view('listing.index', compact('listings'));
    }
    public function show(car $car)
    {
        return view('listing.show', compact('car'));
    }
}
