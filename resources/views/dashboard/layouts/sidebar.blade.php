<ul class="sidebar-nav">
    <li class="sidebar-header">Main</li>

    <li class="sidebar-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('dashboard.index') }}">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
    </li>

    <li class="sidebar-header">Operations</li>

    <li class="sidebar-item {{ request()->routeIs('booking*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('booking.index') }}">
            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Bookings</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('payment*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('payment.index') }}">
            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Payments</span>
        </a>
    </li>

    <li class="sidebar-header">Fleet Management</li>

    <li class="sidebar-item {{ request()->routeIs('car*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('car.index') }}">
            <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Cars</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('category*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('category.index') }}">
            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categories</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('location*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('location.index') }}">
            <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Locations</span>
        </a>
    </li>

    <li class="sidebar-header">Marketing & Communication</li>

    <li class="sidebar-item {{ request()->routeIs('blog_post*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('blog_post.index') }}">
            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Blog</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('testimonial*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('testimonial.index') }}">
            <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Testimonials</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('message*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('message.index') }}">
            <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Messages</span>
        </a>
    </li>

    @can('viewAny', App\Models\User::class)
        <li class="sidebar-header">Settings</li>
        <li class="sidebar-item {{ request()->routeIs('user*') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('user.index') }}">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
            </a>
        </li>
    @endcan
</ul>