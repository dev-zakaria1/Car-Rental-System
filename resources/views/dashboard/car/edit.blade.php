<x-admin-layout>
    
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="index.html">
                <span class="align-middle">AdminKit</span>
            </a>
            @include('dashboard.layouts.sidebar')
            <x-dropdown-link />
        </div>
    </nav>
    <div class="main">
        @include('dashboard.layouts.navigation')
        <div class="d-flex flex-column justify-content-between" style="min-height: 100vh">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">update car</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="category_id">Car Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">— Select Category —</option>
                                    @foreach ($car_categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $car->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="location_id">Location</label>
                                <select class="form-select" id="location_id" name="location_id" required>
                                    <option value="">— Select Location —</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ old('location_id', $car->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="make">Make (Brand)</label>
                                <input type="text" class="form-control" id="make" name="make"
                                    value="{{ old('make', $car->make) }}" required maxlength="100">
                                @error('make')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model"
                                    value="{{ old('model', $car->model) }}" required maxlength="100">
                                @error('model')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="year">Year</label>
                                <input type="number" class="form-control" id="year" name="year"
                                    value="{{ old('year', $car->year) }}" min="1900" max="{{ date('Y') + 1 }}">
                                @error('year')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="registration_no">Registration No</label>
                                <input type="text" class="form-control" id="registration_no" name="registration_no"
                                    value="{{ old('registration_no', $car->registration_no) }}" maxlength="50">
                                @error('registration_no')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="vin">VIN</label>
                                <input type="text" class="form-control" id="vin" name="vin"
                                    value="{{ old('vin', $car->vin) }}" maxlength="100">
                                @error('vin')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="transmission">Transmission</label>
                                <select class="form-select" id="transmission" name="transmission">
                                    <option value="">— Select —</option>
                                    <option value="automatic"
                                        {{ old('transmission', $car->transmission) == 'automatic' ? 'selected' : '' }}>
                                        Automatic</option>
                                    <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>
                                        Manual</option>
                                </select>
                                @error('transmission')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="fuel_type">Fuel Type</label>
                                <select class="form-select" id="fuel_type" name="fuel_type">
                                    <option value="">— Select —</option>
                                    <option value="petrol"
                                        {{ old('fuel_type', $car->fuel_type) == 'petrol' ? 'selected' : '' }}>Petrol
                                    </option>
                                    <option value="diesel"
                                        {{ old('fuel_type', $car->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel
                                    </option>
                                    <option value="hybrid"
                                        {{ old('fuel_type', $car->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid
                                    </option>
                                    <option value="electric"
                                        {{ old('fuel_type', $car->fuel_type) == 'electric' ? 'selected' : '' }}>
                                        Electric</option>
                                    <option value="others"
                                        {{ old('fuel_type', $car->fuel_type) == 'others' ? 'selected' : '' }}>Others
                                    </option>
                                </select>
                                @error('fuel_type')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="available"
                                        {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>
                                        Available</option>
                                    <option value="unavailable"
                                        {{ old('status', $car->status) == 'unavailable' ? 'selected' : '' }}>
                                        Unavailable
                                    </option>
                                    <option value="maintenance"
                                        {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>
                                        Maintenance
                                    </option>
                                    <option value="reserved"
                                        {{ old('status', $car->status) == 'reserved' ? 'selected' : '' }}>
                                        Reserved</option>
                                </select>
                                @error('status')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="doors">Doors</label>
                                <input type="number" class="form-control" id="doors" name="doors"
                                    value="{{ old('doors', $car->doors) }}">
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="seats">Seats</label>
                                <input type="number" class="form-control" id="seats" name="seats"
                                    value="{{ old('seats', $car->seats) }}">
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="luggage">Luggage</label>
                                <input type="number" class="form-control" id="luggage" name="luggage"
                                    value="{{ old('luggage', $car->luggage) }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="hour_rate">Hour Rate</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="hour_rate"
                                        name="hour_rate" value="{{ old('hour_rate',$car->hour_rate) }}"
                                        required>
                                </div>
                                @error('daily_rate')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color"
                                    value="{{ old('color', $car->color) }}" maxlength="50">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="image">Car Image</label>
                                <input type="file" class="form-control" id="image" name="image_url">
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <img src="{{ asset('storage/car_image/' . $car->image_url) }}" alt=""
                                    class="m-1" width="100">
                            </div>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Car Details</button>
                            <a href="{{ route('car.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
