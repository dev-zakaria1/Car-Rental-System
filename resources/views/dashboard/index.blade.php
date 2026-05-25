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
        <main class="content">
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Sales</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="key"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ number_format($salesCount) }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Total bookings made</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Visitors</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ number_format($visitorsCount) }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Registered users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Earnings</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">${{ number_format($totalEarnings, 2) }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Total revenue collected</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pending Orders</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="clock"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $ordersCount }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Awaiting confirmation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Latest Bookings</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th class="d-none d-xl-table-cell">Pickup Date</th>
                                <th class="d-none d-xl-table-cell">Car Model</th>
                                <th>Status</th>
                                <th class="d-none d-md-table-cell">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $booking->pickup_datetime }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $booking->car->model }}</td>
                                    <td>
                                        @if ($booking->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">${{ $booking->total_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        @include('dashboard.layouts.footer')
    </div>
</x-admin-layout>
