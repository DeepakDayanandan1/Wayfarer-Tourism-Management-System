<!-- Main Wayfarer Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-wayfarer">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand-text" href="{{ route('home') }}">
            <div class="brand-logo-icon">
                <i class="fa-solid fa-compass"></i>
            </div>
            <div>
                <span class="brand-name">Wayfarer</span>
                <span class="brand-tagline">Tourism &amp; Expeditions</span>
            </div>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarWayfarerMenu" aria-controls="navbarWayfarerMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarWayfarerMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('page.show') && request()->route('type') == 'aboutus' ? 'active' : '' }}" href="{{ route('page.show', 'aboutus') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('packages.*') ? 'active' : '' }}" href="{{ route('packages.index') }}">Tour Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('page.show') && request()->route('type') == 'privacy' ? 'active' : '' }}" href="{{ route('page.show', 'privacy') }}">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('page.show') && request()->route('type') == 'terms' ? 'active' : '' }}" href="{{ route('page.show', 'terms') }}">Terms of Use</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('page.show') && request()->route('type') == 'contact' ? 'active' : '' }}" href="{{ route('page.show', 'contact') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-wayfarer {{ request()->routeIs('enquiry.*') ? 'active' : '' }}" href="{{ route('enquiry.index') }}">
                        <i class="fa-solid fa-paper-plane me-1 text-coral"></i> Enquiry
                    </a>
                </li>
            </ul>

            <!-- Authentication Controls -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                @auth
                    @php
                        $navRawName = trim(Auth::user()->FullName ?? '');
                        if (empty($navRawName)) {
                            $navRawName = trim(explode('@', Auth::user()->EmailId)[0] ?? 'U');
                        }
                        $navInitial = strtoupper(mb_substr($navRawName, 0, 1));
                    @endphp
                    <div class="dropdown">
                        <button class="btn btn-outline-dark rounded-pill p-1 pe-3 dropdown-toggle fw-semibold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ Auth::user()->FullName ?: Auth::user()->EmailId }}">
                            <span class="user-avatar-circle user-avatar-small">{{ $navInitial }}</span>
                            <span>{{ $navInitial }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-light-subtle rounded-3 p-2">
                            <li class="px-3 py-2 border-bottom mb-1">
                                <strong class="d-block text-dark">{{ Auth::user()->FullName ?: 'Traveler' }}</strong>
                                <small class="text-muted">{{ Auth::user()->EmailId }}</small>
                            </li>
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('profile.index') }}"><i class="fa-solid fa-id-card me-2 text-muted"></i> My Profile</a></li>
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('profile.password') }}"><i class="fa-solid fa-key me-2 text-muted"></i> Change Password</a></li>
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('bookings.history') }}"><i class="fa-solid fa-receipt me-2 text-muted"></i> My Tour History</a></li>
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('issues.index') }}"><i class="fa-solid fa-ticket me-2 text-muted"></i> Support Tickets</a></li>
                            <li><hr class="dropdown-divider my-2"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 rounded-2 text-danger">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-coral py-2 px-4">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

