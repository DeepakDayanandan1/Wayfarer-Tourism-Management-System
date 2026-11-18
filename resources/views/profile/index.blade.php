@extends('layouts.app')

@section('title', 'Wayfarer – My Profile')
@section('body_class', 'page-profile')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Account / Profile</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">My Profile</h1>
		<p>Manage your account settings, personal details, and travel contact preferences.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-md-offset-2">
				<div class="account-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="account-card-header">
						<div class="user-avatar-badge">
							<i class="fa fa-user"></i>
						</div>
						<div class="user-header-info">
							<h2>Personal Information</h2>
							<p>Logged in as <strong>{{ $user->EmailId }}</strong></p>
						</div>
					</div>

					<div class="account-card-body">
						<form name="chngpwd" method="POST" action="{{ route('profile.update') }}">
							@csrf
							<div class="form-group-custom">
								<label for="name"><i class="fa fa-user-o"></i> Full Name</label>
								<input type="text" name="name" value="{{ old('name', $user->FullName) }}" class="form-control-custom" id="name" placeholder="Your full name" required>
							</div> 

							<div class="form-group-custom">
								<label for="mobileno"><i class="fa fa-phone"></i> Mobile Contact Number</label>
								<input type="tel" class="form-control-custom" name="mobileno" maxlength="10" value="{{ old('mobileno', $user->MobileNumber) }}" id="mobileno" placeholder="10-digit mobile number" required>
							</div>

							<div class="form-group-custom">
								<label for="email"><i class="fa fa-envelope-o"></i> Email Address (Account ID)</label>
								<input type="email" class="form-control-custom readonly-input" name="email" value="{{ $user->EmailId }}" id="email" readonly>
								<small class="field-help-text">Email address is tied to your login identity and cannot be altered.</small>
							</div>

							<div class="row meta-dates-row">
								<div class="col-sm-6 meta-date-item">
									<label><i class="fa fa-calendar-check-o"></i> Registered Since</label>
									<p>{{ date('M d, Y', strtotime($user->RegDate)) }}</p>
								</div>
								<div class="col-sm-6 meta-date-item">
									<label><i class="fa fa-history"></i> Last Profile Update</label>
									<p>{{ $user->UpdationDate ? date('M d, Y H:i', strtotime($user->UpdationDate)) : 'Not updated yet' }}</p>
								</div>
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="submit6" class="btn-primary-action"><i class="fa fa-save"></i> Save Profile Changes</button>
								<a href="{{ route('profile.password') }}" class="btn-secondary-link"><i class="fa fa-key"></i> Change Password</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
