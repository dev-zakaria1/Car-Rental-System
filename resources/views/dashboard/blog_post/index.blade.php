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
                    <h5 class="card-title mb-0">Blog</h5>
                    <a class="btn btn-primary btn-sm shadow-sm" href="{{ route('blog_post.create') }}">
                        <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add blog</span>
                    </a>
                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Title & Slug</th>
                            <th class="d-none d-md-table-cell">Author</th>
                            <th class="d-none d-xl-table-cell">Published Date</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th class="d-none d-md-table-cell">images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <strong>{{ $post->title }}</strong><br>
                                    <small class="text-muted">{{ $post->slug }}</small>
                                </td>

                                <td class="d-none d-md-table-cell">
                                    {{ $post->User->name ?? 'Anonymous' }}
                                </td>

                                <td class="d-none d-xl-table-cell">
                                    {{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : 'Not Set' }}
                                </td>

                                <td class="d-none d-md-table-cell">
                                    @if ($post->is_published)
                                        <span class="badge bg-success p-2">Published</span>
                                    @else
                                        <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($post->image)
                                        <img src="{{ asset('storage/blog_images/' . $post->image) }}" width="70"
                                            class="rounded shadow-sm" alt="post">
                                    @else
                                        <img src="{{ asset('/img/no-image.png') }}" width="70"
                                            class="rounded shadow-sm" alt="post">
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex ">

                                        <a href="{{ route('blog_post.edit', $post->id) }}"
                                            class="btn btn-sm btn-primary ms-1">
                                            <i class="align-middle" data-feather="edit"></i>
                                            <span class="align-middle">Edit</span>
                                        </a>
                                        <form action="{{ route('blog_post.delete', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger ms-1" type="submit"><i
                                                    class="align-middle" data-feather="trash-2"></i>
                                                <span class="align-middle">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
