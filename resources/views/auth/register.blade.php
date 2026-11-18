@extends('layouts.app')

@section('title', 'Wayfarer – Sign Up')
@section('body_class', 'page-signup')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Account / Sign Up</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Join the Community</h1>
		<p>Create an explorer account to start planning your next extraordinary journey.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3">
				<div class="account-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="account-card-header">
						<div class="user-avatar-badge">
							<i class="fa fa-user-plus"></i>
						</div>
						<div class="user-header-info">
							<h2>Create Explorer Account</h2>
							<p>Fill out the registration details below</p>
						</div>
					</div>

					<div class="account-card-body">
						<form name="signup" method="POST" action="{{ route('register.submit') }}">
							@csrf
							<div class="form-group-custom">
								<label for="reg_fname"><i class="fa fa-user"></i> Full Name</label>
								<input type="text" value="{{ old('fname') }}" placeholder="Your legal name" name="fname" id="reg_fname" class="form-control-custom" autocomplete="off" required>
							</div>

							<div class="form-group-custom">
								<label for="reg_mobile"><i class="fa fa-phone"></i> Mobile Contact Number</label>
								<input type="tel" value="{{ old('mobilenumber') }}" maxlength="10" name="mobilenumber" id="reg_mobile" placeholder="10-digit mobile number" class="form-control-custom" autocomplete="off" required>
							</div>

							<div class="form-group-custom">
								<label for="reg_email"><i class="fa fa-envelope-o"></i> Email Address</label>
								<input type="email" value="{{ old('email') }}" name="email" id="reg_email" placeholder="name@example.com" class="form-control-custom" autocomplete="off" required>
							</div>

							<div class="form-group-custom">
								<label for="reg_password"><i class="fa fa-key"></i> Choose a Password</label>
								<input type="password" name="password" id="reg_password" placeholder="Create a secure password" class="form-control-custom" required minlength="6">
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="submit" id="submit" class="btn-primary-action"><i class="fa fa-check"></i> Register Account</button>
								<a href="{{ route('login') }}" class="btn-secondary-link"><i class="fa fa-sign-in"></i> Already Registered? Sign In</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
