<x-app-layout>
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }}); height: 300px;">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="intro">
                        <h1><strong>{{ $car->make }} {{ $car->model }}</strong></h1>
                        <div class="custom-breadcrumbs">
                            <a href="{{ route('home.index') }}">Home</a> <span class="mx-2">/</span>
                            <a href="{{ route('listing.index') }}">Listings</a> <span class="mx-2">/</span>
                            <strong>Details</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="listing d-block  align-items-stretch bg-white p-4 rounded shadow-sm">
                        <div class="listing-img mb-4">
                            <img src="{{ asset('storage/car_image/' . $car->image_url) }}" alt="{{ $car->make }}"
                                class="img-fluid rounded">
                        </div>

                        <div class="listing-contents">
                            <h2 class="h3 mb-4 text-black">Vehicle Specifications</h2>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <ul class="list-unstyled custom-list">
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Make:</span> <span>{{ $car->make }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Model:</span>
                                            <span>{{ $car->model }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Year:</span> <span>{{ $car->year }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Transmission:</span> <span
                                                class="text-capitalize">{{ $car->transmission }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled custom-list">
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Fuel Type:</span> <span
                                                class="text-capitalize">{{ $car->fuel_type }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Seats:</span> <span>{{ $car->seats }}
                                                Seats</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Doors:</span> <span>{{ $car->doors }}
                                                Doors</span>
                                        </li>
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span class="font-weight-bold">Color:</span>
                                            <span>{{ $car->color }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="description mt-4">
                                <h4 class="text-black">Location</h4>
                                <p><span class="icon-room mr-2"></span> {{ $car->location->name ?? 'Not Specified' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm sticky-top" style="top: 100px;">
                        <div class="text-center mb-4">
                            <span
                                class="display-4 font-weight-bold text-primary">${{ number_format($car->hour_rate, 2) }}</span>
                            <span class="text-muted">/ day</span>
                        </div>

                        <div class="mb-4">
                            <span
                                class="badge w-100 py-2 {{ $car->status == 'available' ? 'bg-success' : 'bg-danger' }}"
                                style="color:white; font-size: 1rem;">
                                {{ ucfirst($car->status) }}
                            </span>
                        </div>

                        <hr>

                        <p class="text-muted small text-center">Registration No: {{ $car->registration_no }}</p>

                        @if ($car->status == 'available')
                            <a href="#" class="btn btn-primary btn-block py-3">Book This Car Now</a>
                        @else
                            <button class="btn btn-secondary btn-block py-3" disabled>Currently Unavailable</button>
                        @endif

                        <div class="mt-4 p-3 bg-light rounded text-center">
                            <p class="mb-0 small">Need help? Call us at</p>
                            <a href="tel:+123456789" class="font-weight-bold text-black">+1 234 567 89</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.rent')
    @include('layouts.footer')
</x-app-layout>
