<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\car;
use App\Models\car_category;
use App\Models\testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $pickup = $request->pick_up ? Carbon::parse($request->pick_up) : null;
        $dropoff = $request->drop_off ? Carbon::parse($request->drop_off) : null;
        $dataSearch = ['type' => $request->type, 'pick_up' => $pickup, 'drop_off' => $dropoff];

        if (($request->pick_up && !$request->drop_off) || (!$request->pick_up && $request->drop_off)) {
            return redirect()->route('home.index')->with('error', __('You must provide both Pick-up and Drop-off dates together.'));
        }

        $cars = car::available($dataSearch)->where('status', 'available')->paginate(6);
        $categories = car_category::all();
        $testimonials = testimonial::latest()->take(3)->get();
        return view('home', compact('cars', 'categories','testimonials'));
    }
}
