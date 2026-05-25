<?php

namespace App\Providers;

use App\Models\blog_post;
use App\Models\booking;
use App\Models\car;
use App\Models\car_category;
use App\Models\User;
use App\Policies\Blog_postPolicy;
use App\Policies\BookingPolicy;
use App\Policies\CarPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(car_category::class, CategoryPolicy::class);
        Gate::policy(car::class, CarPolicy::class);
        Gate::policy(booking::class, BookingPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(blog_post::class, Blog_postPolicy::class);
        Paginator::useBootstrap();
    }
}
