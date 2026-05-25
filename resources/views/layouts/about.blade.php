<div class="hero inner-page" style="background-image: url({{ asset('images/hero_1_a.jpg') }});">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>About Us</strong></h1>
                    <div class="custom-breadcrumbs">
                        <a href="index.html">Home</a> <span class="mx-2">/</span>
                        <strong>About</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
                <img src="{{ asset('images/hero_2.jpg') }}" alt="Our Fleet" class="img-fluid rounded">
            </div>
            <div class="col-lg-4 mr-auto">
                <h2>Drive with Confidence</h2>
                <p>Founded on the principles of reliability and premium service, our car company provides a seamless
                    rental experience for travelers and locals alike.</p>
                <p>We pride ourselves on maintaining a diverse fleet of well-maintained vehicles, ensuring that whether
                    you need a compact car for the city or an SUV for a family road trip, we have the perfect fit for
                    your journey.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 section-2-title">
            <div class="col-md-6">
                <h2 class="mb-4">Meet Our Team</h2>
            </div>
        </div>
        <div class="row align-items-stretch">

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="post-entry-1 h-100 person-1">
                    <img src="{{ asset('images/person_1.jpg') }}" alt="CEO" class="img-fluid">
                    <div class="post-entry-1-contents">
                        <span class="meta">Founder & CEO</span>
                        <h2>James Anderson</h2>
                        <p>With 20 years in the automotive industry, James leads our vision for modern transportation.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="post-entry-1 h-100 person-1">
                    <img src="{{ asset('images/person_2.jpg') }}" alt="Operations" class="img-fluid">
                    <div class="post-entry-1-contents">
                        <span class="meta">Operations Manager</span>
                        <h2>Sarah Jenkins</h2>
                        <p>Sarah ensures that every vehicle in our fleet is safety-checked and ready for the road.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="post-entry-1 h-100 person-1">
                    <img src="{{ asset('images/person_3.jpg') }}" alt="Customer Relations" class="img-fluid">
                    <div class="post-entry-1-contents">
                        <span class="meta">Customer Relations</span>
                        <h2>Michael Chen</h2>
                        <p>Michael is dedicated to providing world-class support and a smooth booking process for every
                            client.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="{{ asset('images/hero_1.jpg') }}" alt="Our History" class="img-fluid rounded">
            </div>
            <div class="col-lg-4 ml-auto">
                <h2>Our History</h2>
                <p>We started as a small family-owned garage with just three cars. Over the last decade, we have grown
                    into a leading rental provider known for transparency and fair pricing.</p>
                <p>Our mission remains the same: to provide affordable, high-quality mobility solutions that empower our
                    customers to explore the world without limits.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-primary py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-md-0">
                <h2 class="mb-0 text-white">Ready to hit the road?</h2>
                <p class="mb-0 opa-7">Book your vehicle today and enjoy premium comfort at the most competitive rates in
                    the market.</p>
            </div>

            <div class="col-lg-5 text-md-right">
                <a href="{{ route('listing.index') }}" class="btn btn-primary btn-white">Rent a car now</a>
            </div>
        </div>
    </div>
</div>
