@extends('layouts.app')

@section('title', 'Wayfarer – Custom Travel Enquiry')
@section('body_class', 'page-enquiry')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Contact / Enquiry</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Send an Enquiry</h1>
		<p>Plan a bespoke holiday, customize an existing tour, or request special corporate packages.</p>
	</div>
</div>

<div class="enquiry-page-section">
	<div class="container">
		<div class="row enquiry-layout-row">
			<!-- Contact Information Cards -->
			<div class="col-md-5 enquiry-info-col wow fadeInLeft animated" data-wow-delay=".2s">
				<div class="enquiry-info-box">
					<span class="info-tag">Concierge Desk</span>
					<h3>We're here to make your journey effortless.</h3>
					<p>Whether you're organizing a solo trek, luxury honeymoon, or group excursion, our travel advisors are ready to craft the perfect itinerary.</p>
					
					<div class="contact-channels">
						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-phone"></i></div>
							<div class="channel-details">
								<strong>Toll-Free Helpline</strong>
								<span>123-4568790 / +91 98765 43210</span>
								<small>Mon - Sat: 9:00 AM - 8:00 PM IST</small>
							</div>
						</div>

						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-envelope-o"></i></div>
							<div class="channel-details">
								<strong>Email Concierge</strong>
								<span>concierge@wayfarer.com</span>
								<small>Average response time: 2 hours</small>
							</div>
						</div>

						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-map-marker"></i></div>
							<div class="channel-details">
								<strong>Headquarters</strong>
								<span>Wayfarer Expeditions House, Dwarka Sector 12, New Delhi 110096</span>
								<small>Open for scheduled appointments</small>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Form Column -->
			<div class="col-md-7 enquiry-form-col wow fadeInRight animated" data-wow-delay=".3s">
				<div class="enquiry-form-card">
					<div class="form-card-header">
						<h3>Plan Your Custom Experience</h3>
						<p>Fill out the details below and an adventure curator will prepare an itinerary proposal.</p>
					</div>

					<form name="enquiry" method="POST" action="{{ route('enquiries.store') }}">
						@csrf
						<div class="form-group-custom">
							<label for="fname"><i class="fa fa-user"></i> Full Name</label>
							<input type="text" name="fname" class="form-control-custom" id="fname" placeholder="Your name" value="{{ old('fname', Auth::user()->FullName ?? '') }}" required>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="email"><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" name="email" class="form-control-custom" id="email" placeholder="name@example.com" value="{{ old('email', Auth::user()->EmailId ?? '') }}" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="mobileno"><i class="fa fa-phone"></i> Mobile Number</label>
									<input type="tel" name="mobileno" class="form-control-custom" id="mobileno" maxlength="10" placeholder="10-digit mobile number" value="{{ old('mobileno', Auth::user()->MobileNumber ?? '') }}" required>
								</div>
							</div>
						</div>

						<div class="form-group-custom">
							<label for="subject"><i class="fa fa-tag"></i> Trip Subject / Destination Interest</label>
							<input type="text" name="subject" class="form-control-custom" id="subject" placeholder="e.g. 7-Day Swiss Alps Family Tour" value="{{ old('subject') }}" required>
						</div>

						<div class="form-group-custom">
							<label for="description"><i class="fa fa-pencil"></i> Tell Us What You're Looking For</label>
							<textarea name="description" class="form-control-custom" rows="5" id="description" placeholder="Travel dates, group size, preferred accommodations, special requirements..." required>{{ old('description') }}</textarea>
						</div>

						<div class="form-action-wrap">
							<button type="submit" name="submit1" class="btn-primary-action"><i class="fa fa-paper-plane"></i> Send Travel Enquiry</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
