<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', testimonial::class);
        $testimonials = testimonial::paginate(10);
        return view('dashboard.testimonial.index', compact('testimonials'));
    }
    public function delete(testimonial $testimonial)
    {
        $this->authorize('delete', $testimonial);
        if ($testimonial->avatar_url) {
            Storage::disk('public')->delete('/testimonial_img/' . $testimonial->avatar_url);
        }
        $testimonial->delete();
        return redirect()->route('testimonial.index')->with('success', 'testimonial deleted successfully');
    }
}
