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
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add New Location</h5>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create New Blog Post</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog_post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" placeholder="Enter post title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Slug (URL)</label>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}" placeholder="post-url-format">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Excerpt (Short Description)</label>
                                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image">Blog Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Publish Date & Time</label>
                                        <input type="datetime-local" name="published_at"
                                            class="form-control @error('published_at') is-invalid @enderror"
                                            value="{{ old('published_at') }}">
                                        @error('published_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="author_id" value="{{ auth()->id() }}">

                                    <div class="col-md-4 mb-3 d-flex align-items-end">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="is_published"
                                                value="1" id="isPublished"
                                                {{ old('is_published') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isPublished">Publish
                                                Immediately</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('blog_post.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </div>
</x-admin-layout>
