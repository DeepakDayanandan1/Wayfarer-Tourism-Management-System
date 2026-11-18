@extends('layouts.app')

@section('title', 'Wayfarer – ' . $package->PackageName)
@section('body_class', 'page-package-details')

@section('content')
<!-- Inner Page Banner -->
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('packages.index') }}">Packages</a> / Details</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">{{ $package->PackageName }}</h1>
		<p>Review comprehensive trip highlights, inclusions, and reserve your departure date.</p>
	</div>
</div>

<div class="details-page-section">
	<div class="container">	
		<form name="book" method="POST" action="{{ route('bookings.store', $package->PackageId) }}">
			@csrf
			<div class="row details-layout-row">
				<!-- Left Column: Package Highlights & Description -->
				<div class="col-md-7 col-lg-8 details-left-col wow fadeInLeft animated" data-wow-delay=".2s">
					<div class="package-hero-card">
						<div class="package-hero-img-wrap">
							<img src="{{ asset('admin/pacakgeimages/' . $package->PackageImage) }}" alt="{{ $package->PackageName }}" class="img-responsive">
							<span class="package-hero-type"><i class="fa fa-tag"></i> {{ $package->PackageType }}</span>
						</div>
						<div class="package-hero-meta">
							<span class="pkg-code">ID: #PKG-{{ $package->PackageId }}</span>
							<h2>{{ $package->PackageName }}</h2>
							<div class="pkg-location">
								<i class="fa fa-map-marker"></i> <span>{{ $package->PackageLocation }}</span>
							</div>
						</div>
					</div>

					<div class="package-content-block">
						<h3><i class="fa fa-list-ul"></i> Package Features &amp; Inclusions</h3>
						<div class="package-features-box">
							<p>{{ $package->PackageFetures }}</p>
						</div>
					</div>

					<div class="package-content-block">
						<h3><i class="fa fa-file-text-o"></i> Overview &amp; Experience Highlights</h3>
						<div class="package-description-box">
							<p>{!! nl2br(e($package->PackageDetails)) !!}</p>
						</div>
					</div>

					<div class="package-content-block trust-strip">
						<div class="row">
							<div class="col-sm-4 trust-item">
								<i class="fa fa-check-square-o"></i>
								<strong>Instant Confirmation</strong>
								<span>Fast booking verification</span>
							</div>
							<div class="col-sm-4 trust-item">
								<i class="fa fa-calendar-check-o"></i>
								<strong>Flexible Dates</strong>
								<span>Custom departures available</span>
							</div>
							<div class="col-sm-4 trust-item">
								<i class="fa fa-shield"></i>
								<strong>Best Price Guarantee</strong>
								<span>No hidden surcharge</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column: Sticky Reservation Box -->
				<div class="col-md-5 col-lg-4 details-right-col wow fadeInRight animated" data-wow-delay=".3s">
					<div class="booking-card-sticky">
						<div class="booking-card-header">
							<span class="book-card-label">Total Package Price</span>
							<div class="booking-price">
								<span class="currency">&#8377;</span>
								<span class="amount">{{ number_format($package->PackagePrice) }}</span>
								<span class="per-unit">/ person</span>
							</div>
						</div>

						<div class="booking-card-body">
							<div class="form-group-custom">
								<label for="datepicker2"><i class="fa fa-calendar"></i> Departure Date (From)</label>
								<input class="form-control-custom date-input" id="datepicker2" type="date" name="fromdate" required>
							</div>

							<div class="form-group-custom">
								<label for="datepicker3"><i class="fa fa-calendar"></i> Return Date (To)</label>
								<input class="form-control-custom date-input" id="datepicker3" type="date" name="todate" required>
							</div>

							<div class="form-group-custom">
								<label for="comment"><i class="fa fa-commenting-o"></i> Special Requests or Notes</label>
								<textarea class="form-control-custom" id="comment" name="comment" rows="3" placeholder="Tell us about dietary preferences, airport pickup, or special requests..."></textarea>
							</div>

							<div class="booking-cta-wrap">
								@if(Auth::check())
									<button type="submit" name="submit2" class="btn-book-now">
										<i class="fa fa-check"></i> Complete Reservation
									</button>
								@else
									<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-book-now">
										<i class="fa fa-sign-in"></i> Sign In to Reserve
									</a>
									<span class="guest-book-hint">You need an active account to book a tour.</span>
								@endif
							</div>

							<div class="booking-guarantee-note">
								<i class="fa fa-lock"></i> Secure SSL Checkout. You will not be charged until confirmed.
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split("T")[0];
    const fromEl = document.getElementById("datepicker2");
    const toEl = document.getElementById("datepicker3");
    if(fromEl) {
      fromEl.setAttribute("min", today);
      fromEl.addEventListener("change", function() {
        if(toEl) toEl.setAttribute("min", this.value);
      });
    }
    if(toEl) {
      toEl.setAttribute("min", today);
    }
  });
</script>
@endsection
