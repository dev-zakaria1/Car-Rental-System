<x-app-layout>
    <x-alert />
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">
        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">
                    <div class="intro">
                        <h1><strong>Contact Us</strong></h1>
                        <div class="custom-breadcrumbs">
                            <a href="{{ url('/') }}">Home</a> <span class="mx-2">/</span>
                            <strong>Contact</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                    <h2>Contact Us Or Use This Form To Rent A Car</h2>
                    <p>Have questions about our fleet or need a custom quote? Fill out the form below and our team will
                        get back to you shortly.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <form action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 mb-4 mb-lg-0">
                                <input type="text" name="first_name" class="form-control" placeholder="First name"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" name="email" class="form-control" placeholder="Email address"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="message" class="form-control" placeholder="Write your message or rental details here..." cols="30"
                                    rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mr-auto">
                                <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5"
                                    value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4 ml-auto">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-black mb-4">Contact Info</h3>
                        <ul class="list-unstyled footer-link">
                            <li class="d-block mb-3">
                                <span class="d-block text-black">Address:</span>
                                <span>
                                    @foreach ($locations as $location)
                                        {{ $location->name . ',' }}
                                    @endforeach
                                </span>
                            </li>
                            <li class="d-block mb-3">
                                <span class="d-block text-black">Phone:</span>
                                <span>{{ $location->phone }}</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    
</x-app-layout>
