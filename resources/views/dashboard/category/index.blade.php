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
                    <h5 class="card-title mb-0">categories</h5>
                    <a class="btn btn-primary btn-sm shadow-sm" href="{{ route('category.create') }}">
                        <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add category</span>
                    </a>
                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>description</th>
                            <th>update</th>
                            @can('delete', \App\Models\car_category::class)
                                <th>delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categroies as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>


                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                @can('delete', $category)
                                    <td>
                                        <form action="{{ route('category.delete', $category->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                            {{ $categroies->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
