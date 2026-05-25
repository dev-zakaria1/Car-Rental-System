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
                    <h5 class="card-title mb-0">User</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-xl-table-cell">Phone</th>
                            <th class="d-none d-xl-table-cell">Role</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Joined At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <strong>{{ $user->name }}</strong><br>
                                    <small class="text-muted">ID: #{{ $user->id }}</small>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                                <td class="d-none d-xl-table-cell">{{ $user->phone ?? 'N/A' }}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if ($user->role != 'admin')
                                        @php
                                            $roleClasses = [
                                                'admin' => 'text-danger',
                                                'staff' => 'text-primary',
                                                'customer' => 'text-info',
                                            ];
                                            $currentRoleClass = $roleClasses[$user->role] ?? 'text-secondary';
                                        @endphp

                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" onchange="checkAdminRole(this,'{{ $user->role }}')"
                                                class="form-select form-select-sm border-0 fw-bold {{ $currentRoleClass }}"
                                                style="background: transparent; cursor: pointer;">
                                                @foreach ($roleClasses as $role => $class)
                                                    <option value="{{ $role }}"
                                                        {{ $user->role == $role ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="is_active" value="{{ $user->is_active }}">
                                        </form>
                                    @else
                                        <span class="badge bg-danger p-2">Admin</span>
                                    @endif
                                </td>


                                <td>
                                    @php
                                        $statusOptions = [
                                            1 => ['label' => 'Active', 'class' => 'text-success'],
                                            0 => ['label' => 'Inactive', 'class' => 'text-danger'],
                                        ];
                                        $currentStatusClass =
                                            $statusOptions[$user->is_active]['class'] ?? 'text-secondary';
                                    @endphp

                                    @if (!($user->role == 'admin' && $user->is_active == true))
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="is_active" onchange="this.form.submit()"
                                                class="form-select form-select-sm border-0 fw-bold {{ $currentStatusClass }}"
                                                style="background: transparent; cursor: pointer;">
                                                @foreach ($statusOptions as $val => $opt)
                                                    <option value="{{ $val }}"
                                                        {{ $user->is_active == $val ? 'selected' : '' }}>
                                                        {{ $opt['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="role" value="{{ $user->role }}">
                                        </form>
                                    @else
                                        <span class="badge bg-danger p-2">active</span>
                                    @endif
                                </td>

                                <td class="d-none d-md-table-cell">
                                    {{ $user->created_at->format('Y-m-d') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
