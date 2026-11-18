@extends('layouts.app')

@section('title', 'Wayfarer – For people who love exploring')

@section('content')
<!-- Hero Section -->
<div class="banner banner-hero">
	<div class="banner-overlay"></div>
	<div class="container hero-container">
		<div class="hero-copy wow fadeInUp animated" data-wow-delay=".2s">
			<span class="hero-badge"><i class="fa fa-compass"></i> For People Who Love Exploring</span>
			<h1>Untamed Horizons,<br><span>Unforgettable Stories</span></h1>
			<p class="hero-description">Discover thoughtfully planned expeditions, breathtaking mountain landscapes, exotic coastal escapes, and unforgettable cultural journeys designed for the true explorer.</p>
			<div class="hero-action-group">
				<a class="hero-action" href="{{ route('packages.index') }}">
					<i class="fa fa-map-o"></i> Explore Tour Packages
				</a>
				<a class="hero-secondary-action" href="{{ route('enquiries.index') }}">
					<i class="fa fa-plane"></i> Plan Custom Trip
				</a>
			</div>
		</div>
	</div>
</div>

<!-- Features Value Proposition Strip -->
<section class="features-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".2s">
				<div class="feature-icon"><i class="fa fa-compass"></i></div>
				<div class="feature-text">
					<h4>Curated Trails</h4>
					<p>Scenic journeys &amp; hand-picked accommodations.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".3s">
				<div class="feature-icon"><i class="fa fa-shield"></i></div>
				<div class="feature-text">
					<h4>Safe &amp; Protected</h4>
					<p>Verified bookings &amp; 100% financial protection.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".4s">
				<div class="feature-icon"><i class="fa fa-users"></i></div>
				<div class="feature-text">
					<h4>Expert Guides</h4>
					<p>Local specialists and 24/7 dedicated concierge.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".5s">
				<div class="feature-icon"><i class="fa fa-tag"></i></div>
				<div class="feature-text">
					<h4>Transparent Rates</h4>
					<p>Honest pricing with no hidden tourist markups.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Featured Packages Section -->
<section class="holiday-section">
	<div class="container">
		<div class="section-header wow fadeInDown animated" data-wow-delay=".2s">
			<span class="section-tag">Curated Expeditions</span>
			<h2>Trending Travel Experiences</h2>
			<p>Hand-picked itineraries loved by adventurous travelers, couples, and wandering families.</p>
		</div>

		<div class="packages-grid">
			@forelse($featuredPackages as $result)
			<div class="package-card wow fadeInUp animated" data-wow-delay=".3s">
				<div class="package-card-inner">
					<div class="package-thumb">
						<img src="{{ asset('admin/pacakgeimages/' . $result->PackageImage) }}" alt="{{ $result->PackageName }}">
						<span class="package-type-badge">{{ $result->PackageType }}</span>
					</div>
					<div class="package-body">
						<div class="package-location">
							<i class="fa fa-map-marker"></i> {{ $result->PackageLocation }}
						</div>
						<h3 class="package-title">
							<a href="{{ route('packages.show', $result->PackageId) }}">
								{{ $result->PackageName }}
							</a>
						</h3>
						<p class="package-features">
							<i class="fa fa-check-circle"></i> {{ $result->PackageFetures }}
						</p>
					</div>
					<div class="package-footer">
						<div class="package-price-wrap">
							<span class="price-label">Starting from</span>
							<span class="package-price">&#8377; {{ number_format($result->PackagePrice) }}</span>
						</div>
						<a href="{{ route('packages.show', $result->PackageId) }}" class="btn-view-details">
							View Details <i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
			@empty
			<div class="col-xs-12 text-center">
				<p class="text-muted">No featured tour packages available at this moment.</p>
			</div>
			@endforelse
		</div>

		<div class="view-all-wrapper wow fadeInUp animated" data-wow-delay=".4s">
			<a href="{{ route('packages.index') }}" class="btn-view-all">
				Browse All Packages <i class="fa fa-long-arrow-right"></i>
			</a>
		</div>
	</div>
</section>

<!-- Trust & Stats Counter -->
<section class="routes-section">
	<div class="container">
		<div class="row stats-row">
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".2s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-compass"></i></div>
					<div class="stat-content">
						<h3>{{ number_format($stats['enquiries'] ?? 80000) }}+</h3>
						<p>Inquiries Answered</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".3s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-users"></i></div>
					<div class="stat-content">
						<h3>{{ number_format($stats['users'] ?? 1900) }}+</h3>
						<p>Active Wayfarers</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".4s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-globe"></i></div>
					<div class="stat-content">
						<h3>{{ number_format($stats['miles'] ?? 700000) }}+</h3>
						<p>Miles Explored</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Call to Action Banner (Classy & Refined) -->
<section class="cta-banner-section">
	<div class="container">
		<div class="cta-banner-inner wow zoomIn animated" data-wow-delay=".2s">
			<div class="cta-content">
				<span class="cta-subtitle"><i class="fa fa-compass"></i> Start Your Expedition</span>
				<h2>Ready to explore uncharted horizons with Wayfarer?</h2>
				<p>Let our experienced travel curators build an expedition customized to your pace, style, and wanderlust.</p>
				<div class="cta-buttons">
					<a href="{{ route('enquiries.index') }}" class="btn-cta-primary"><i class="fa fa-paper-plane"></i> Plan My Custom Trip</a>
					<a href="{{ route('packages.index') }}" class="btn-cta-secondary"><i class="fa fa-compass"></i> Browse All Tours</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
