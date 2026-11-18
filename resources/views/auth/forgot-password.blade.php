@extends('layouts.app')

@section('title', 'Wayfarer – Recover Password')
@section('body_class', 'page-recover-password')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Account / Recover</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Recover Password</h1>
		<p>Verify your registered mobile number and email to securely set a new password.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3">
				<div class="account-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="account-card-header">
						<div class="user-avatar-badge">
							<i class="fa fa-question-circle"></i>
						</div>
						<div class="user-header-info">
							<h2>Account Verification</h2>
							<p>Enter your registration details below to verify identity</p>
						</div>
					</div>

					<div class="account-card-body">
						<form name="chngpwd" method="POST" action="{{ route('password.update') }}" onsubmit="return validReset();">
							@csrf
							<div class="form-group-custom">
								<label for="recovery_email"><i class="fa fa-envelope-o"></i> Registered Email Address</label>
								<input type="email" name="email" class="form-control-custom" id="recovery_email" placeholder="name@example.com" value="{{ old('email') }}" required>
							</div>

							<div class="form-group-custom">
								<label for="recovery_mobile"><i class="fa fa-phone"></i> Registered Mobile Number</label>
								<input type="tel" name="mobile" class="form-control-custom" id="recovery_mobile" placeholder="10-digit mobile number" maxlength="10" value="{{ old('mobile') }}" required>
							</div>

							<div class="form-group-custom">
								<label for="newpassword"><i class="fa fa-key"></i> New Password</label>
								<input type="password" class="form-control-custom" name="newpassword" id="newpassword" placeholder="Enter new strong password" required minlength="4">
							</div>

							<div class="form-group-custom">
								<label for="confirmpassword"><i class="fa fa-check"></i> Confirm New Password</label>
								<input type="password" class="form-control-custom" name="confirmpassword" id="confirmpassword" placeholder="Re-enter new password" required minlength="4">
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="submit50" class="btn-primary-action"><i class="fa fa-check"></i> Reset Password</button>
								<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-secondary-link"><i class="fa fa-sign-in"></i> Sign In</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function validReset() {
	if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
		alert("New Password and Confirm Password do not match.");
		document.chngpwd.confirmpassword.focus();
		return false;
	}
	return true;
}
</script>
@endsection
