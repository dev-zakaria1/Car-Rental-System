<?php

use App\Http\Controllers\admin\Blog_postsController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\CarCategroyController;
use App\Http\Controllers\admin\CarController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\BookingController as ControllersBookingController;
use App\Models\blog_post;
use Illuminate\Support\Facades\Route;


Route::prefix('/console')->middleware(['auth', 'role:staff', 'is_active'])->group(function () {
    Route::prefix('/location')->group(function () {
        Route::get('/index', [LocationController::class, 'index'])->name('location.index');
        Route::get('/create', [LocationController::class, 'create'])->name('location.create');
        Route::post('/store', [LocationController::class, 'store'])
            ->name('location.store')
            ->middleware('throttle:30,1');
        Route::get('/edit/{location}', [LocationController::class, 'edit'])->name('location.edit');
        Route::put('/update/{location}', [LocationController::class, 'update'])
            ->name('location.update')
            ->middleware('throttle:30,1');
        Route::delete('/delete/{location}', [LocationController::class, 'delete'])
            ->name('location.delete')
            ->middleware('throttle:10,1');
    });
    Route::prefix('/category')->group(function () {
        Route::get('/index', [CarCategroyController::class, 'index'])->name('category.index');
        Route::get('/create', [CarCategroyController::class, 'create'])->name('category.create');
        Route::post('/store', [CarCategroyController::class, 'store'])->name('category.store')->middleware('throttle:30,1');
        Route::delete('/delete/{car_category}', [CarCategroyController::class, 'delete'])->name('category.delete')->middleware('throttle:10,1');
        Route::get('/edit/{car_category}', [CarCategroyController::class, 'edit'])->name('category.edit');
        Route::put('/update/{car_category}', [CarCategroyController::class, 'update'])->name('category.update')->middleware('throttle:30,1');
    });
    Route::prefix('/car')->group(function () {
        Route::get('/index', [CarController::class, 'index'])->name('car.index');
        Route::get('/create', [CarController::class, 'create'])->name('car.create');
        Route::post('/store', [CarController::class, 'store'])->name('car.store')->middleware('throttle:30,1');
        Route::get('/show/{car}', [CarController::class, 'show'])->name('car.show');
        Route::get('/edit/{car}', [CarController::class, 'edit'])->name('car.edit');
        Route::put('/update/{car}', [CarController::class, 'update'])->name('car.update')->middleware('throttle:30,1');
        Route::delete('/delete/{car}', [CarController::class, 'delete'])->name('car.delete')->middleware('throttle:10,1');
    });
    Route::prefix('/booking')->group(function () {
        Route::get('/index', [BookingController::class, 'index'])->name('booking.index');
        Route::patch('/update/{booking}', [BookingController::class, 'update'])->name('booking.update')->middleware('throttle:30,1');
    });
    Route::prefix('/payment')->group(function () {
        Route::get('/index', [PaymentController::class, 'index'])->name('payment.index');
    });
    Route::prefix('/user')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::patch('/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('throttle:30,1');
    });
    Route::prefix('/blog_post')->group(function () {
        Route::get('/index', [Blog_postsController::class, 'index'])->name('blog_post.index');
        Route::get('/create', [Blog_postsController::class, 'create'])->name('blog_post.create');
        Route::post('/store', [Blog_postsController::class, 'store'])->name('blog_post.store')->middleware('throttle:30,1');
        Route::get('/edit/{blog_post}', [Blog_postsController::class, 'edit'])->name('blog_post.edit');
        Route::put('/update/{blog_post}', [Blog_postsController::class, 'update'])->name('blog_post.update')->middleware('throttle:30,1');
        Route::delete('/delete/{blog_post}', [Blog_postsController::class, 'delete'])->name('blog_post.delete')->middleware('throttle:10,1');
    });
    Route::prefix('/testimonial')->group(function () {
        Route::get('/index', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::delete('/delete/{testimonial}', [TestimonialController::class, 'delete'])->name('testimonial.delete')->middleware('throttle:10,1');
    });
    Route::prefix('/message')->group(function () {
        Route::get('index', [ContactController::class, 'index'])->name('message.index');
        Route::patch('update/{message}', [ContactController::class, 'update'])->name('message.update')->middleware('throttle:30,1');
        Route::delete('delete/{message}', [ContactController::class, 'delete'])->name('message.delete')->middleware('throttle:10,1');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/multiAuth/public/driver/login', function () {
    return view('driver.login');
});
Route::get('/multiAuth/public/driver/register', function () {
    return view('driver.register');
});
Route::post('/booking/store', [ControllersBookingController::class, 'store'])->name('booking.store')->middleware('auth', 'throttle:30,1');
Route::get('/booking/checkout', [ControllersBookingController::class, 'checkout'])->name('booking.checkout')->middleware('auth', 'throttle:30,1');
Route::get('/bookings/show', [ControllersBookingController::class, 'show'])->name('booking.show')->middleware('auth');
Route::post('/bookings/complete', [ControllersBookingController::class, 'completePament'])->name('booking.complete')->middleware('auth');
Route::get('/payment-success', [ControllersBookingController::class, 'successPament'])->name('payment.success')->middleware('auth');

Route::post('/booking/cancel-expired/{id}', [ControllersBookingController::class, 'cancelExpired'])->name('booking.cancel')->middleware('auth', 'throttle:30,1');
require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
