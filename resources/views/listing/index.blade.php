<x-app-layout>
    <x-alert />
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">

        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-12">
                    <div class="intro d-flex justify-content-between align-items-end">
                        <div class="intro">
                            <h1><strong>Listings</strong></h1>
                            <div class="custom-breadcrumbs"><a href="index.html">Home</a> <span class="mx-2">/</span>
                                <strong>Listings</strong>
                            </div>
                        </div>
                        @auth
                            <div class="mb-3">
                                <a href="{{ route('booking.show') }}" class="btn btn-warning fw-bold shadow-sm">
                                    📅 My Bookings
                                </a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 id="car-listings-section" class="section-heading"><strong>Car Listings</strong></h2>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($listings as $listing)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="listing d-flex flex-column h-100 w-100 border rounded overflow-hidden">

                            <div class="listing-img">
                                <a href="{{route('listing.show',$listing->id)}}">
                                    <img src="{{ asset('storage/car_image/' . $listing->image_url) }}"
                                        alt="{{ $listing->make }}" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </a>
                            </div>

                            <div class="listing-contents p-3 d-flex flex-column flex-grow-1">
                                <h3>{{ $listing->make }} {{ $listing->model }}</h3>

                                <div class="rent-price mb-3">
                                    <strong>${{ number_format($listing->hour_rate, 2) }}</strong><span
                                        class="mx-1">/</span>day
                                </div>

                                <div class="d-flex mb-3 border-bottom pb-3">
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Luggage:</span>
                                        <span class="number d-block"><strong>{{ $listing->luggage }}</strong></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Doors:</span>
                                        <span class="number d-block"><strong>{{ $listing->doors }}</strong></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Passenger:</span>
                                        <span class="number d-block"><strong>{{ $listing->seats }}</strong></span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <p>
                                        <small class="text-muted">
                                            Transmission: {{ ucfirst($listing->transmission) }} <br>
                                            Fuel Type: {{ ucfirst($listing->fuel_type) }}
                                        </small>
                                    </p>
                                    <p class="mb-0"><a href="{{ route('bookings.create', $listing->id) }}"
                                            class="btn btn-primary btn-block">Rent
                                            Now</a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="custom-pagination">
                        {{ $listings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('layouts.rent')


    @include('layouts.footer')
</x-app-layout>
