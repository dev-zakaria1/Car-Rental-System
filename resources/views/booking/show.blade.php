<x-app-layout>
    <x-alert />
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">
        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-12">
                    <div class="intro d-flex justify-content-between align-items-end">
                        <div class="intro">
                            <h1><strong>My Bookings</strong></h1>
                            <div class="custom-breadcrumbs">
                                <a href="{{ url('/') }}">Home</a> <span class="mx-2">/</span>
                                <strong>Bookings</strong>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('listing.index') }}" class="btn btn-primary fw-bold shadow-sm">
                                🚗 Browse More Cars
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Your Reservations</strong></h2>
                    <p class="mb-5">Manage and track your current and past car rentals.</p>
                </div>
            </div>

            <div class="row">
                @forelse ($bookings as $booking)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="listing d-block align-items-stretch">
                            <div class="listing-img h-100 mr-4">
                                <img src="{{ asset('storage/car_image/' . $booking->car->image_url) }}" alt="Image"
                                    class="img-fluid">
                            </div>
                            <div class="listing-contents h-100">
                                <h3>{{ $booking->car->car_category->name }}</h3>

                                <div class="rent-price mb-3">
                                    <span class="text-muted small">Total Paid:</span>
                                    <strong>{{ number_format($booking->total_price, 2) }} €</strong>
                                </div>

                                <div class="d-block mb-3 border-bottom pb-3">
                                    <div class="listing-feature">
                                        <span class="caption">Pickup:</span>
                                        <span class="number">{{ $booking->pickup_datetime }}</span>
                                    </div>
                                    <div class="listing-feature">
                                        <span class="caption">Dropoff:</span>
                                        <span class="number">{{ $booking->dropoff_datetime }}</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    @php
                                        $statusClass =
                                            [
                                                'pending' => 'bg-warning',
                                                'confirmed' => 'bg-success',
                                                'paid' => 'bg-info',
                                                'cancelled' => 'bg-danger',
                                                'in_progress' => 'bg-primary',
                                                'completed' => 'bg-dark',
                                            ][$booking->status] ?? 'bg-secondary';
                                    @endphp

                                    <span class="badge {{ $statusClass }} shadow-sm"
                                        style="color:white; padding: 10px 15px; border-radius: 50px;">
                                        <i class="ps-1 fa-solid fa-circle-info"></i> {{ ucfirst($booking->status) }}
                                    </span>

                                    @if ($booking->status == 'pending')
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('booking.checkout') }}"
                                                class="btn btn-primary btn-sm d-flex align-items-center shadow-sm"
                                                style="border-radius: 5px; padding: 8px 15px;">
                                                <i class="icon-payment mr-1"></i> Pay Now
                                            </a>

                                            <form action="{{ route('booking.cancel', $booking->id) }}" method="post"
                                                class="m-0">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm d-flex align-items-center shadow-sm"
                                                    style="border-radius: 5px; padding: 8px 15px;"
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="h4 text-muted">You don't have any bookings yet.</div>
                        <a href="{{ route('listing.index') }}" class="btn btn-primary mt-3">Rent a Car Now</a>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="custom-pagination">
                        {{ $bookings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>
