<x-app-layout>
    <x-alert />
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">

        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">

                    <div class="intro">
                        <h1><strong>Listings</strong></h1>
                        <div class="custom-breadcrumbs"><a href="index.html">Home</a> <span class="mx-2">/</span>
                            <strong>Listings</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-5">
                        <h2 class="mb-4">Book Your Car: {{ $car->car_category->name }}</h2>

                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="pickup_location_id">Pickup Location</label>
                                    <select name="pickup_location_id" id="pickup_location_id" class="form-control"
                                        required>
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}"
                                                {{ old('pickup_location_id') == $location->id ? 'selected' : '' }}>
                                                {{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pickup_location_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="dropoff_location_id">Drop-off Location</label>
                                    <select name="dropoff_location_id" id="dropoff_location_id" class="form-control"
                                        required>
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}"
                                                {{ old('dropoff_location_id') == $location->id ? 'selected' : '' }}>
                                                {{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('dropoff_location_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="pickup_datetime">Pickup Date & Time</label>
                                    <input type="datetime-local" name="pickup_datetime" class="form-control"
                                        value="{{ old('pickup_datetime') }}" required>
                                    @error('pickup_datetime')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="dropoff_datetime">Drop-off Date & Time</label>
                                    <input type="datetime-local" name="dropoff_datetime"
                                        value="{{ old('dropoff_datetime') }}" class="form-control" required>
                                    @error('dropoff_datetime')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="method" class="form-control" required>
                                        <option value="card" {{ old('method') == 'card' ? 'selected' : '' }}>
                                            Credit Card</option>
                                    </select>
                                    @error('method')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="notes">Additional Notes</label>
                                    <textarea name="notes" class="form-control" cols="30" rows="3" placeholder="Any special requests?">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block py-3">Confirm
                                        Booking</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
