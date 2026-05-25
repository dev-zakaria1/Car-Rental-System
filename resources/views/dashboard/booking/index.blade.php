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
                    <h5 class="card-title mb-0">booking</h5>

                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Car</th>
                            <th class="d-none d-md-table-cell">Pickup Info</th>
                            <th class="d-none d-md-table-cell">Dropoff Info</th>
                            <th>Total Price</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <strong>{{ $booking->user->name }}</strong><br>
                                    <small class="text-muted">{{ $booking->user->email }}</small>
                                </td>
                                <td>
                                    {{ $booking->car->make }} {{ $booking->car->model }}<br>
                                    <small
                                        class="badge bg-light text-dark border">{{ $booking->car->registration_no }}</small>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="text-primary"><i class="align-middle" data-feather="map-pin"></i>
                                        {{ $booking->pickup_location->name }}</span><br>
                                    <small>{{ $booking->pickup_datetime }}</small>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="text-danger"><i class="align-middle" data-feather="map-pin"></i>
                                        {{ $booking->dropoff_location->name }}</span><br>
                                    <small>{{ $booking->dropoff_datetime }}</small>
                                </td>
                                <td>
                                    <strong>${{ number_format($booking->total_price, 2) }}</strong>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'text-info',
                                            'confirmed' => 'text-primary',
                                            'in_progress' => 'text-warning',
                                            'completed' => 'text-success',
                                            'cancelled' => 'text-danger',
                                        ];
                                        $currentClass = $statusClasses[$booking->status] ?? 'text-secondary';
                                    @endphp
                                    @can('update', $booking)
                                        <form action="{{ route('booking.update', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="form-select form-select-sm border-0 fw-bold {{ $currentClass }}"
                                                style="background: transparent; cursor: pointer;">
                                                @foreach ($statusClasses as $status => $class)
                                                    <option value="{{ $status }}"
                                                        {{ $booking->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        <div class="{{ $currentClass }}">{{ $booking->status }}</div>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $bookings->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
