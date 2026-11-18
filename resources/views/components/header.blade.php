<header class="floating-header-wrapper">
	<nav class="floating-navbar" aria-label="Main Navigation">
		<!-- Brand Logo -->
		<div class="nav-brand">
			<a href="{{ route('home') }}" class="brand-link">
				<span class="brand-icon-wrap"><i class="fa fa-compass" aria-hidden="true"></i></span>
				<div class="brand-text">
					<span class="brand-title">Wayfarer</span>
					<span class="brand-tagline">For people who love exploring</span>
				</div>
			</a>
		</div>

		<!-- Desktop Navigation Links -->
		<div class="nav-menu-desktop">
			<ul class="nav-links">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('packages.index') }}">Tours</a></li>
				<li><a href="{{ route('pages.show', 'aboutus') }}">About</a></li>
				<li><a href="{{ route('pages.show', 'contact') }}">Contact</a></li>
				@if(Auth::check())
					<li><a href="#" data-toggle="modal" data-target="#myModal3">Write Us</a></li>
				@else
					<li><a href="{{ route('enquiries.index') }}">Enquiry</a></li>
				@endif
			</ul>
		</div>

		<!-- Action / Account Section -->
		<div class="nav-actions">
			@if(Auth::check())
				@php
					$rawName = trim(Auth::user()->FullName ?? '');
					if (empty($rawName)) {
						$rawName = trim(explode('@', Auth::user()->EmailId)[0] ?? 'U');
					}
					$userInitial = strtoupper(mb_substr($rawName, 0, 1));
				@endphp
				<div class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle user-pill" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="{{ Auth::user()->FullName ?: Auth::user()->EmailId }}">
						<span class="user-avatar-circle">{{ $userInitial }}</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right custom-nav-dropdown">
						<li class="dropdown-header">
							<div style="display: flex; align-items: center; gap: 10px;">
								<span class="user-avatar-circle user-avatar-small">{{ $userInitial }}</span>
								<div class="user-dropdown-meta">
									<strong class="user-dropdown-name">{{ Auth::user()->FullName ?: 'Traveler' }}</strong>
									<small class="user-dropdown-email">{{ Auth::user()->EmailId }}</small>
								</div>
							</div>
						</li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ route('profile.index') }}"><i class="fa fa-user"></i> My Profile</a></li>
						<li><a href="{{ route('bookings.history') }}"><i class="fa fa-suitcase"></i> My Tour History</a></li>
						<li><a href="{{ route('issues.index') }}"><i class="fa fa-ticket"></i> Support Tickets</a></li>
						<li><a href="{{ route('profile.password') }}"><i class="fa fa-key"></i> Change Password</a></li>
						<li role="separator" class="divider"></li>
						<li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-logout">
								<i class="fa fa-sign-out"></i> Log Out
							</a>
						</li>
					</ul>
				</div>
			@else
				<div class="auth-buttons">
					<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-nav-signin">Sign In</a>
					<a href="#" data-toggle="modal" data-target="#myModal" class="btn-nav-signup">Sign Up</a>
				</div>
			@endif

			<!-- Mobile Hamburger Toggle -->
			<button type="button" class="mobile-toggle-btn" id="wayfarerMobileToggle" aria-label="Toggle navigation">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</button>
		</div>
	</nav>

	<!-- Mobile Drawer Dropdown -->
	<div class="mobile-nav-drawer" id="wayfarerMobileDrawer">
		<ul class="mobile-nav-list">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{{ route('packages.index') }}"><i class="fa fa-map-o"></i> Tour Packages</a></li>
			<li><a href="{{ route('pages.show', 'aboutus') }}"><i class="fa fa-info-circle"></i> About Us</a></li>
			<li><a href="{{ route('pages.show', 'contact') }}"><i class="fa fa-envelope-o"></i> Contact</a></li>
			<li><a href="{{ route('pages.show', 'privacy') }}"><i class="fa fa-shield"></i> Privacy Policy</a></li>
			<li><a href="{{ route('pages.show', 'terms') }}"><i class="fa fa-file-text-o"></i> Terms of Use</a></li>
			@if(Auth::check())
				@php
					$mobRawName = trim(Auth::user()->FullName ?? '');
					if (empty($mobRawName)) {
						$mobRawName = trim(explode('@', Auth::user()->EmailId)[0] ?? 'U');
					}
					$mobInitial = strtoupper(mb_substr($mobRawName, 0, 1));
				@endphp
				<li class="mobile-user-item">
					<div class="mobile-user-badge">
						<span class="user-avatar-circle">{{ $mobInitial }}</span>
						<div class="mobile-user-details">
							<strong>{{ Auth::user()->FullName ?: 'Traveler' }}</strong>
							<small>{{ Auth::user()->EmailId }}</small>
						</div>
					</div>
				</li>
				<li class="mobile-divider"></li>
				<li><a href="{{ route('profile.index') }}"><i class="fa fa-user"></i> My Profile</a></li>
				<li><a href="{{ route('bookings.history') }}"><i class="fa fa-suitcase"></i> Tour History</a></li>
				<li><a href="{{ route('issues.index') }}"><i class="fa fa-ticket"></i> Support Tickets</a></li>
				<li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil-square-o"></i> Write Us</a></li>
				<li><a href="{{ route('profile.password') }}"><i class="fa fa-key"></i> Change Password</a></li>
				<li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mobile-logout">
						<i class="fa fa-sign-out"></i> Log Out
					</a>
				</li>
			@else
				<li><a href="{{ route('enquiries.index') }}"><i class="fa fa-plane"></i> Trip Enquiry</a></li>
				<li><a href="{{ route('admin.login') }}"><i class="fa fa-lock"></i> Admin Portal</a></li>
				<li class="mobile-auth-cta">
					<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-mobile-signin">Sign In</a>
					<a href="#" data-toggle="modal" data-target="#myModal" class="btn-mobile-signup">Sign Up</a>
				</li>
			@endif
		</ul>
	</div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Mobile Drawer Toggle
	var toggleBtn = document.getElementById('wayfarerMobileToggle');
	var drawer = document.getElementById('wayfarerMobileDrawer');
	if (toggleBtn && drawer) {
		toggleBtn.addEventListener('click', function(e) {
			e.stopPropagation();
			toggleBtn.classList.toggle('active');
			drawer.classList.toggle('open');
		});
		document.addEventListener('click', function(e) {
			if (!drawer.contains(e.target) && !toggleBtn.contains(e.target)) {
				drawer.classList.remove('open');
				toggleBtn.classList.remove('active');
			}
		});
	}

	// Desktop User Dropdown Toggle Fallback
	var userToggle = document.querySelector('.user-dropdown .user-pill');
	var userDropdown = document.querySelector('.user-dropdown');
	if (userToggle && userDropdown) {
		userToggle.addEventListener('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			userDropdown.classList.toggle('open');
		});
		document.addEventListener('click', function(e) {
			if (!userDropdown.contains(e.target)) {
				userDropdown.classList.remove('open');
			}
		});
	}
});
</script>
