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
                    <h5 class="card-title mb-0">Testimonials</h5>

                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Content</th>
                            <th>Rating</th>
                            <th>Status</th>
                            @can('delete', \App\Models\testimonial::class)
                                <th>Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($testimonial->avatar_url)
                                            <img src="{{ asset('storage/testimonial_img/' . $testimonial->avatar_url) }}"
                                                class="rounded-circle me-2" width="35" height="35"
                                                alt="Avatar">
                                        @else
                                            <img src="{{ asset('img/no-image.png') }}" class="rounded-circle me-2"
                                                width="35" height="35" alt="Avatar">
                                        @endif
                                        <div>
                                            <strong>{{ $testimonial->user_name }}</strong><br>
                                            <small class="text-muted">{{ $testimonial->user_title }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Str::limit($testimonial->content, 50) }}</td>
                                <td>
                                    <span class="text-warning">
                                        {{ $testimonial->rating }} <i class="fas fa-star"></i>
                                    </span>
                                </td>
                                <td>
                                    @if ($testimonial->is_visible)
                                        <span class="badge bg-success">Visible</span>
                                    @else
                                        <span class="badge bg-secondary">Hidden</span>
                                    @endif
                                </td>

                                @can('delete', $testimonial)
                                    <td>
                                        <form action="{{ route('testimonial.delete', $testimonial->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
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
                            {{ $testimonials->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
