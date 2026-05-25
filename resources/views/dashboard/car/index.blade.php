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
            <div>
                @include('dashboard.layouts.alert')
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">cars</h5>
                    <a class="btn btn-primary btn-sm shadow-sm" href="{{ route('car.create') }}">
                        <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add car</span>
                    </a>
                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Make & Model</th>
                            <th class="d-none d-md-table-cell">Category</th>
                            <th class="d-none d-xl-table-cell">Year</th>
                            <th class="d-none d-xl-table-cell">Registration No</th>
                            <th>Daily Rate</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th>show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td>
                                    @if ($car->image_url)
                                        <img src="{{ asset('storage/car_image/' . $car->image_url) }}" width="50"
                                            class="rounded shadow-sm" alt="car">
                                    @else
                                        <img src="/img/no-image.png" width="50" class="rounded shadow-sm"
                                            alt="car">
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $car->make }}</strong><br>
                                    <small class="text-muted">{{ $car->model }}</small>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $car->car_category->name ?? 'N/A' }}</td>
                                <td class="d-none d-xl-table-cell">{{ $car->year }}</td>
                                <td class="d-none d-xl-table-cell">{{ $car->registration_no }}</td>
                                <td><span class="badge bg-success">${{ number_format($car->hour_rate, 2) }}</span></td>
                                <td class="d-none d-md-table-cell">
                                    <span class="badge {{ $car->status == 'available' ? 'bg-primary' : 'bg-warning' }}">
                                        {{ ucfirst($car->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('car.show', $car->id) }}" class="btn btn-sm btn-primary">
                                        <i class="align-middle" data-feather="eye"></i>
                                        <span class="align-middle">Show</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $cars->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
