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
                    <h5 class="card-title mb-0">Payment</h5>

                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Booking Reference</th>
                            <th>Customer</th>
                            <th class="d-none d-md-table-cell">Payment Method</th>
                            <th class="d-none d-md-table-cell">Transaction Ref</th>
                            <th>Amount</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>
                                    <strong>#BK-{{ $payment->booking_id }}</strong>
                                </td>
                                <td>
                                    {{ $payment->booking->user->name }}
                                </td>
                                <td class="d-none d-md-table-cell">
                                    @php
                                        $methodIcons = [
                                            'card' => 'credit-card',
                                            'paypal' => 'payout',
                                            'bank_transfer' => 'home',
                                            'cash' => 'dollar-sign',
                                            'others' => 'more-horizontal',
                                        ];
                                        $icon = $methodIcons[$payment->method] ?? 'help-circle';
                                    @endphp
                                    <span class="badge bg-light text-dark border">
                                        <i class="align-middle me-1" data-feather="{{ $icon }}"></i>
                                        {{ ucfirst(str_replace('_', ' ', $payment->method)) }}
                                    </span>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <small class="text-muted">{{ $payment->transaction_ref ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <strong class="text-dark">{{ number_format($payment->amount, 2) }}
                                        {{ $payment->currency }}</strong>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'text-info',
                                            'paid' => 'text-success',
                                            'failed' => 'text-danger',
                                            'refunded' => 'text-warning',
                                        ];
                                        $currentClass = $statusClasses[$payment->status] ?? 'text-secondary';
                                    @endphp

                                    {{-- إذا كان المستخدم أدمن يمكنه تغيير الحالة يدوياً (مثلاً للدفع الكاش) --}}
                                    @can('update', $payment)
                                        <form action="{{ route('payments.update', $payment->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="form-select form-select-sm border-0 fw-bold {{ $currentClass }}"
                                                style="background: transparent; cursor: pointer;">
                                                @foreach ($statusClasses as $status => $class)
                                                    <option value="{{ $status }}"
                                                        {{ $payment->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        <span class="fw-bold {{ $currentClass }}">{{ ucfirst($payment->status) }}</span>
                                    @endcan
                                </td>
                                <td>
                                    <small>{{ $payment->paid_at }}</small>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $payments->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
