<x-app-layout>


    <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">

        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">

                    <div class="intro">
                        <h1><strong>Blog</strong></h1>
                        <div class="custom-breadcrumbs"><a href="index.html">Home</a> <span class="mx-2">/</span>
                            <strong>Blog</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                @foreach ($blog_posts as $blog_post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="post-entry-1 h-100">
                            <a href="{{ route('blog.show', $blog_post->id) }}">

                                @if ($blog_post->image)
                                    <div style="width: 100%; height: 300px; object-fit: cover;">
                                        <img src="{{ asset('storage/blog_images/' . $blog_post->image) }}"
                                            class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                    </div>
                                @else
                                    <div style="width: 100%; height: 300px; object-fit: cover;">

                                        <img src="{{ asset('/img/no-image.png') }}" alt="Image" class="img-fluid">
                                    </div>
                                @endif
                            </a>

                            <div class="post-entry-1-contents">

                                <h2><a href="{{ route('blog.show', $blog_post->id) }}">{{ $blog_post->title }}</a></h2>
                                <span class="meta d-inline-block mb-3">{{ $blog_post->published_at }} <span
                                        class="mx-2">by</span> <a href="#">Admin</a></span>
                                <p>{{ $blog_post->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="custom-pagination">
                        {{ $blog_posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.rent')
    @include('layouts.footer')
</x-app-layout>
