 <header class="site-navbar site-navbar-target" role="banner">
     <div class="container">
         <div class="row align-items-center position-relative">

             <div class="col-3">
                 <div class="site-logo">
                     <a href="index.html"><strong>CarRental</strong></a>
                 </div>
             </div>

             <div class="col-9 text-right">
                 <span class="d-inline-block d-lg-none">
                     <a href="#" class="site-menu-toggle js-menu-toggle py-5">
                         <span class="icon-menu h3 text-black"></span>
                     </a>
                 </span>

                 <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                     <ul class="site-menu main-menu js-clone-nav ml-auto">
                         <li class="@if (request()->routeIs('home*')) active @endif"><a href="{{ route('home.index') }}"
                                 class="nav-link">Home</a></li>
                         <li class="@if (request()->routeIs('listing*')) active @endif"><a
                                 href="{{ route('listing.index') }}" class="nav-link">Listing</a></li>
                         <li class="@if (request()->routeIs('testimonials*')) active @endif"><a
                                 href="{{ route('testimonials.index') }}" class="nav-link">Testimonials</a></li>
                         <li class="@if (request()->routeIs('blog*')) active @endif"><a href="{{ route('blog.index') }}"
                                 class="nav-link">Blog</a></li>
                         <li class="@if (request()->routeIs('about*')) active @endif"><a
                                 href="{{ route('about.index') }}" class="nav-link">About</a></li>
                         <li class="@if (request()->routeIs('contact*')) active @endif"><a
                                 href="{{ route('contact.index') }}" class="nav-link">Contact</a></li>
                         @auth
                             @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                                 <li><a href="{{ route('dashboard.index') }}"
                                         class="nav-link text-primary font-weight-bold">Dashboard</a></li>
                             @endif

                             <li class="has-children">
                                 <a href="#" class="nav-link text-black">Hi, {{ auth()->user()->name }}</a>
                                 <ul class="dropdown">
                                     <li>
                                         <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                             style="display: none;">
                                             @csrf
                                         </form>
                                         <a href="#"
                                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                     </li>
                                 </ul>
                             </li>
                         @else
                             <li><a href="{{ route('login') }}" class="nav-link">Log In</a></li>
                             <li><a href="{{ route('register') }}" class="nav-link btn btn-primary text-white px-3 py-2"
                                     style="line-height: 1;">Register</a></li>
                         @endauth
                     </ul>
                 </nav>
             </div>

         </div>
     </div>
 </header>
