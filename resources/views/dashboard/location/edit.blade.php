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
                    <h5 class="card-title mb-0">Edit Location</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('location.update', $location) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Location Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $location->name) }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $location->phone) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address_line1">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1"
                                value="{{ old('address_line1', $location->address_line1) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address_line2">Address Line 2 (Optional)</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2"
                                value="{{ old('address_line2', $location->address_line2) }}">
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city', $location->city) }}" required>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{ old('state', $location->state) }}">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="{{ old('postal_code', $location->postal_code) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <select class="form-select" id="country" name="country">
                                <option value="USA"
                                    {{ old('country', $location->country) == 'USA' ? 'selected' : '' }}>United States
                                </option>
                                <option value="UK"
                                    {{ old('country', $location->country) == 'UK' ? 'selected' : '' }}>United Kingdom
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Location</button>
                        <a href="{{ route('location.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
