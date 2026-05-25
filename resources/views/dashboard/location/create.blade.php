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
                    <h5 class="card-title mb-0">Add New Location</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('location.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Location Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required maxlength="150">
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone') }}" maxlength="50">
                                @error('phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address_line1">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1"
                                value="{{ old('address_line1') }}" required maxlength="255">
                            @error('address_line1')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address_line2">Address Line 2 (Optional)</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2"
                                value="{{ old('address_line2') }}" maxlength="255">
                            @error('address_line2')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city') }}" required maxlength="100">
                                @error('city')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{ old('state') }}" maxlength="100">
                                @error('state')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="{{ old('postal_code') }}" maxlength="30">
                                @error('postal_code')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="">— Select —</option>
                                <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States</option>
                                <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                            </select>
                            @error('country')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Location</button>
                        <a href="{{ route('location.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
