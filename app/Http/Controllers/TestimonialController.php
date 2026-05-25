<?php

namespace App\Http\Controllers;

use App\Http\Requests\testimonials\StoreTestimonialRequest;
use App\Models\testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = testimonial::latest()->paginate(9);
        return view('testimonial.index', compact('testimonials'));
    }
    public function create()
    {
        return view('testimonial.create');
    }
    public function store(StoreTestimonialRequest $request)
    {
        $validated = $request->validated();
        $testimonial = testimonial::create($validated);
        if ($request->hasFile('avatar_url')) {
            $fileName = $request->file('avatar_url');
            $img = $testimonial->id . "." . $fileName->extension();
            $fileName->storeAs('testimonial_img/', $img, 'public');
            $testimonial->update(['avatar_url' => $img]);
        }
        return redirect()->route('testimonials.index')->with('success', __('Testimonial Is Created'));
    }
}
