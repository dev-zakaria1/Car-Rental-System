<x-app-layout>
    <x-alert />
    
    <div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">
        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">
                    <div class="intro">
                        <h1><strong>Share Your Experience</strong></h1>
                        <div class="custom-breadcrumbs">
                            <a href="{{ url('/') }}">Home</a> <span class="mx-2">/</span>
                            <a href="{{ route('testimonials.index') }}">Testimonials</a> <span class="mx-2">/</span>
                            <strong>Add New</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5">
                    <form action="{{route('testimonials.store')}}" method="post" enctype="multipart/form-data" class="bg-white p-5 shadow-sm rounded">
                        @csrf
                        
                        <h3 class="text-black mb-4">Your Information</h3>
                        <div class="form-group row">
                            <div class="col-md-6 mb-4 mb-lg-0">
                                <label class="text-black" for="user_name">Full Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="E.g. John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="user_title">Title / Company</label>
                                <input type="text" name="user_title" id="user_title" class="form-control" placeholder="E.g. CEO at TechCorp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-4">
                                <label class="text-black" for="avatar_url">Profile Picture (Optional)</label>
                                <input type="file" name="avatar_url" id="avatar_url" class="form-control-file border p-2 w-100 rounded">
                            </div>
                        </div>

                        <hr class="my-4">
                        <h3 class="text-black mb-4">Your Review</h3>

                        <div class="form-group row">
                            <div class="col-md-12 mb-4">
                                <label class="text-black" for="rating">Rating</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-4">
                                <label class="text-black" for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="Write your testimonial here..." required></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_visible" name="is_visible" value="1" checked>
                                    <label class="custom-control-label" for="is_visible">Publish immediately (Visible to everyone)</label>
                                </div>
                                <small class="text-muted">If unchecked, the testimonial will be saved as a draft.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block text-white py-3 px-5 rounded-pill shadow">
                                    Submit Testimonial
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>