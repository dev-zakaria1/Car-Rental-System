<?php

use App\Http\Controllers\Blog_postsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\TestimonialController;
use App\Models\testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::prefix('/contact')->group(function () {
    Route::get('index', [ContactController::class, 'index'])->name('contact.index');
    Route::post('store', [ContactController::class, 'store'])->name('contact.store');
});
Route::get('/about/index', function () {
    return view('about');
})->name('about.index');
Route::get('/blog/index', [Blog_postsController::class, 'index'])->name('blog.index');
Route::get('/blog/show/{blog_post}', [Blog_postsController::class, 'show'])->name('blog.show');
Route::get('/testimonial/index', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonials.store');

Route::get('listing/index', [ListingController::class, 'index'])->name('listing.index');
Route::get('listing/show/{car}', [ListingController::class, 'show'])->name('listing.show');
Route::get('Booking/create/{car}', [BookingController::class, 'create'])->name('bookings.create')->middleware('auth');
Route::post('Booking/store/', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');
