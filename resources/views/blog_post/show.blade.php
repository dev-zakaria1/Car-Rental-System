<x-app-layout>
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="intro">
                        <h1><strong>{{ $blog_post->title }}</strong></h1>
                        <div class="pb-4">
                            <strong class="text-black">
                                blog_posted on
                                {{ $blog_post->published_at ? $blog_post->published_at->format('M d, Y') : $blog_post->created_at->format('M d, Y') }}
                                &bullet; By {{ $blog_post->user->name }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-content">
                    @if ($blog_post->excerpt)
                        <p class="lead">{{ $blog_post->excerpt }}</p>
                    @endif

                    <div>
                        {!! $blog_post->content !!}
                    </div>
                </div>

                <div class="col-md-4 sidebar">
                    <div class="sidebar-box">
                        <h3 class="text-black">About The Author</h3>
                        <p>Name: {{ $blog_post->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.rent')
    @include('layouts.footer')
</x-app-layout>