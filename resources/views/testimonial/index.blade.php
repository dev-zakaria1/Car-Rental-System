<x-app-layout>
    <x-alert />
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">

        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">

                    <div class="intro">
                        <h1><strong>Testimonials</strong></h1>
                        <div class="custom-breadcrumbs"><a href="index.html">Home</a> <span class="mx-2">/</span>
                            <strong>Testimonials</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="site-section bg-light">
        <div class="container">

            <div class="row align-items-center mb-5">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Testimonials</strong></h2>
                    <p>What our clients say about us.</p>
                </div>
                <div class="col-lg-5 text-lg-right">
                    <a href="{{ route('testimonials.create') }}"
                        class="btn btn-outline-primary btn-md px-4 rounded-pill shadow-sm">
                        Share Your Experience +
                    </a>
                </div>
            </div>
            <div class="row">
                @foreach ($testimonials as $testimonial)
                    <div class="col-lg-4 mb-4">
                        <div class="testimonial-2">
                            <blockquote class="mb-4">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt
                                    eveniet veniam. Ipsam, nam, voluptatum"</p>
                            </blockquote>
                            <div class="d-flex v-card align-items-center">
                                @if ($testimonial->avatar_url)
                                    <img src="{{ asset('storage/testimonial_img/' . $testimonial->avatar_url) }}"
                                        alt="Image" class="img-fluid mr-3">
                                @else
                                    <img src="{{ asset('img/no-image.png') }}" alt="Image" class="img-fluid mr-3">
                                @endif
                                <div class="author-name">
                                    <span class="d-block">{{ $testimonial->user_name }}</span>
                                    <span>owner ,{{ $testimonial->title }}</span>
                                    <span>rating: {{ $testimonial->rating }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="custom-pagination">
                        {{ $testimonials->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layouts.rent')


    @include('layouts.footer')
</x-app-layout>
