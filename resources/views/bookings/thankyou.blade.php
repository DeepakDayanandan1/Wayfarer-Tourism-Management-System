@extends('layouts.app')

@section('title', 'Wayfarer – Confirmation')
@section('body_class', 'page-confirmation')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Confirmation</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Confirmation</h1>
		<p>Thank you for traveling with Wayfarer.</p>
	</div>
</div>

<div class="confirmation-page-section">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="confirmation-card wow zoomIn animated" data-wow-delay=".3s">
					<div class="confirm-icon-wrap">
						<i class="fa fa-check-circle"></i>
					</div>
					<h2>Request Received</h2>
					<p class="confirm-message">
						@if(session('success'))
							{{ session('success') }}
						@elseif(session('msg'))
							{{ session('msg') }}
						@else
							Your booking request has been submitted successfully! Check your tour history for status updates.
						@endif
					</p>
					<div class="confirm-actions">
						@if(Auth::check())
							<a href="{{ route('packages.index') }}" class="btn-primary-action"><i class="fa fa-compass"></i> Explore Tour Packages</a>
							<a href="{{ route('bookings.history') }}" class="btn-secondary-link"><i class="fa fa-history"></i> View My History</a>
						@else
							<a href="{{ route('home') }}" class="btn-primary-action"><i class="fa fa-home"></i> Back to Homepage</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
