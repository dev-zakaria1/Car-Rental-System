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
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Vehicle Image</h5>
                    </div>
                    <div class="card-body text-center">
                        @if ($car->image_url)
                            <img src="{{ asset('storage/car_image/' . $car->image_url) }}" alt="{{ $car->model }}"
                                class="img-fluid mb-2" width="128" height="128" />
                        @else
                            <img src="{{ asset('/img/no-image.png') }}" alt="Default" class="img-fluid mb-2"
                                width="128" height="128" />
                        @endif
                        <h4 class="mb-0">{{ $car->make }}</h4>
                        <div class="text-muted mb-2">{{ $car->model }} ({{ $car->year }})</div>

                        <div>
                            @if ($car->status == 'available')
                                <span class="badge bg-success">Available</span>
                            @elseif($car->status == 'unavailable')
                                <span class="badge bg-danger">Unavailable</span>
                            @elseif($car->status == 'maintenance')
                                <span class="badge bg-warning text-dark">Maintenance</span>
                            @else
                                <span class="badge bg-info">Booked</span>
                            @endif
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Pricing</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><strong>Hour Rate:</strong> <span
                                    class="text-success fw-bold">${{ number_format($car->hour_rate, 2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Technical Info & Specifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>Category:</th>
                                            <td>{{ $car->car_category->name ?? 'Not Defined' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location:</th>
                                            <td>{{ $car->location->name ?? 'Not Defined' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Plate Number:</th>
                                            <td>{{ $car->registration_no ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>VIN:</th>
                                            <td>{{ $car->vin ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>Transmission:</th>
                                            <td>{{ ucfirst($car->transmission) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fuel Type:</th>
                                            <td>{{ ucfirst($car->fuel_type) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Color:</th>
                                            <td>{{ $car->color ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Added Date:</th>
                                            <td>{{ $car->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row text-center mt-4">
                            <div class="col-4">
                                <div class="border p-2 rounded">
                                    <i data-feather="users" class="mb-1"></i>
                                    <div class="fw-bold">Seats</div>
                                    <div>{{ $car->seats ?? 0 }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border p-2 rounded">
                                    <i data-feather="briefcase" class="mb-1"></i>
                                    <div class="fw-bold">Luggage</div>
                                    <div>{{ $car->luggage ?? 0 }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border p-2 rounded">
                                    <i data-feather="door-closed" class="mb-1"></i>
                                    <div class="fw-bold">Doors</div>
                                    <div>{{ $car->doors ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('car.edit', $car->id) }}" class="btn btn-primary">Edit Details</a>
                            @can('delete', App\Models\car::class)
                                <form action="{{ route('car.delete', $car->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete
                                        Vehicle</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
