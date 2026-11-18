@extends('layouts.app')

@section('title', 'Wayfarer – For people who love exploring | Tour Packages')
@section('body_class', 'page-packages')

@section('content')
<!-- Page Banner -->
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Packages</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Explore Tour Packages</h1>
		<p>Hand-picked journeys, cultural immersions, and breathtaking holiday getaways.</p>
	</div>
</div>

<!-- Package List -->
<div class="packages-page-section">
	<div class="container">
		<div class="package-list-topbar">
			<div class="list-count-info">
				<h3>Available Experiences ({{ $packages->total() }})</h3>
				<p>All packages include verified accommodations, dedicated guide support, and standard amenities.</p>
			</div>
		</div>

		<div class="packages-grid">
			@forelse($packages as $result)
			<div class="package-card wow fadeInUp animated" data-wow-delay=".2s">
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
							<span class="price-label">Price per person</span>
							<span class="package-price">&#8377; {{ number_format($result->PackagePrice) }}</span>
						</div>
						<a href="{{ route('packages.show', $result->PackageId) }}" class="btn-view-details">
							View Itinerary <i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
			@empty
			<div class="col-xs-12 text-center" style="padding: 60px 0;">
				<h3>No packages found</h3>
				<p class="text-muted">Please check back soon or submit a custom trip inquiry.</p>
				<a href="{{ route('enquiries.index') }}" class="btn-primary-action">Plan Custom Trip</a>
			</div>
			@endforelse
		</div>

		@if($packages->hasPages())
		<div class="pagination-wrapper text-center" style="margin-top: 40px;">
			{{ $packages->links() }}
		</div>
		@endif
	</div>
</div>
@endsection
