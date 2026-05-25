<x-app-layout>
    <x-alert />
    <div class="hero" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">

                    <div class="row mb-5">
                        <div class="col-lg-7 intro">
                            <h1><strong>Rent a car</strong> is within your finger tips.</h1>
                        </div>
                    </div>
                    <form class="trip-form" action="#car-results">
                        <div class="row
                        align-items-center">
                            <div class="mb-3 mb-md-0 col-md-3">
                                <select name="type" id="" class="custom-select form-control">
                                    <option value="">Select Type</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"{{ request()->type == $category->id ? 'selected' : '' }}>
                                            {{ ucfirst($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                    <input type="text" id="cf-3" placeholder="Pick up" name="pick_up"
                                        value="{{ request()->pick_up ? request()->pick_up : '' }}"
                                        class="form-control datepicker px-3">
                                    <span class="icon icon-date_range"></span>

                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                    <input type="text" id="cf-4" placeholder="Drop off" name="drop_off"
                                        value="{{ request()->drop_off ? request()->drop_off : '' }}"
                                        class="form-control datepicker px-3">
                                    <span class="icon icon-date_range"></span>
                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <input type="submit" value="Search Now" class="btn btn-primary btn-block py-3">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('layouts.HowWork')
    @include('layouts.option')
    <div class="site-section bg-light" id="car-results">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Car Listings</strong></h2>
                    <p class="mb-5">All your dream cars here</p>
                </div>
            </div>
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="listing d-flex flex-column h-100 w-100 border rounded overflow-hidden">

                            <div class="listing-img">
                                <img src="{{ $car->image_url ? asset('storage/car_image/' . $car->image_url) : asset('img/no-image.png') }}"
                                    alt="{{ $car->make }}" class="img-fluid w-100"
                                    style="height: 200px; object-fit: cover;">
                            </div>

                            <div class="listing-contents p-3 d-flex flex-column flex-grow-1">
                                <h3>{{ $car->make }} {{ $car->model }}</h3>

                                <div class="rent-price mb-3">
                                    <strong>${{ number_format($car->hour_rate, 2) }}</strong><span
                                        class="mx-1">/</span>day
                                </div>

                                <div class="d-flex mb-3 border-bottom pb-3">
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Luggage:</span>
                                        <span class="number d-block"><strong>{{ $car->luggage }}</strong></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Doors:</span>
                                        <span class="number d-block"><strong>{{ $car->doors }}</strong></span>
                                    </div>
                                    <div class="listing-feature pr-4">
                                        <span class="caption">Passenger:</span>
                                        <span class="number d-block"><strong>{{ $car->seats }}</strong></span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <p>
                                        <small class="text-muted">
                                            Transmission: {{ ucfirst($car->transmission) }} <br>
                                            Fuel Type: {{ ucfirst($car->fuel_type) }}
                                        </small>
                                    </p>
                                    <p class="mb-0"><a href="{{ route('bookings.create', $car->id) }}"
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
                        {{ $cars->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.features')
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Testimonials</strong></h2>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="row">

                @foreach ($testimonials as $testimonial)
                    <div class="col-lg-4 mb-4">
                        <div class="testimonial-2">
                            <blockquote class="mb-4">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt
                                    eveniet veniam. Ipsam, nam, voluptatum"</p>
                            </blockquote>
                            <div class="d-flex v-card align-items-center">
                                @if ($testimonial->avatar_url)
                                    <img src="{{ asset('storage/testimonial_img/' . $testimonial->avatar_url) }}"
                                        alt="Image" class="img-fluid mr-3">
                                @else
                                    <img src="{{ asset('img/no-image.png') }}" alt="Image" class="img-fluid mr-3">
                                @endif
                                <div class="author-name">
                                    <span class="d-block">{{ $testimonial->user_name }}</span>
                                    <span>owner ,{{ $testimonial->title }}</span>
                                    <span>rating: {{ $testimonial->rating }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
