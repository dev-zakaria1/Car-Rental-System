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
                    <h5 class="card-title mb-0">Locations</h5>
                    <a class="btn btn-primary btn-sm shadow-sm" href="{{ route('location.create') }}">
                        <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add Location</span>
                    </a>
                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Address_line1</th>
                            <th class="d-none d-xl-table-cell">Address_line2</th>
                            <th>City</th>
                            <th class="d-none d-md-table-cell">Country</th>
                            <th class="d-none d-xl-table-cell">State</th>
                            <th class="d-none d-xl-table-cell">Postal_code</th>
                            <th class="d-none d-xl-table-cell">Phone</th>
                            <th>update</th>
                            @can('delete', App\Models\location::class)
                                <th>delete</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td class="d-none d-xl-table-cell">{{ $location->address_line1 }}</td>
                                <td class="d-none d-xl-table-cell">{{ $location->address_line2 }}</td>
                                <td><span>{{ $location->city }}</span></td>
                                <td class="d-none d-md-table-cell">{{ $location->country }}</td>
                                <td class="d-none d-xl-table-cell">{{ $location->state }}</td>
                                <td class="d-none d-xl-table-cell">{{ $location->postal_code }}</td>
                                <td class="d-none d-xl-table-cell">{{ $location->phone }}</td>
                                <td class="text-center">
                                    <a href="{{ route('location.edit', $location->id) }}"
                                        class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                @can('delete', $location)
                                    <td>
                                        <form action="{{ route('location.delete', $location->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this location?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $locations->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
