@extends('layouts.app')

@section('title', 'Wayfarer – Change Password')
@section('body_class', 'page-change-password')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Account / Password</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Change Password</h1>
		<p>Update your authentication password to keep your Wayfarer account secure.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3">
				<div class="account-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="account-card-header">
						<div class="user-avatar-badge">
							<i class="fa fa-lock"></i>
						</div>
						<div class="user-header-info">
							<h2>Update Credentials</h2>
							<p>Logged in as <strong>{{ Auth::user()->EmailId }}</strong></p>
						</div>
					</div>

					<div class="account-card-body">
						<form name="chngpwd" method="POST" action="{{ route('profile.password.update') }}" onsubmit="return validPassword();">
							@csrf
							<div class="form-group-custom">
								<label for="current_password"><i class="fa fa-key"></i> Current Password</label>
								<input type="password" name="password" class="form-control-custom" id="current_password" placeholder="Enter current password" required>
							</div>

							<div class="form-group-custom">
								<label for="newpassword"><i class="fa fa-shield"></i> New Password</label>
								<input type="password" class="form-control-custom" name="newpassword" id="newpassword" placeholder="Enter new strong password" required minlength="6">
							</div>

							<div class="form-group-custom">
								<label for="confirmpassword"><i class="fa fa-check"></i> Confirm New Password</label>
								<input type="password" class="form-control-custom" name="confirmpassword" id="confirmpassword" placeholder="Re-enter new password" required minlength="6">
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="submit5" class="btn-primary-action"><i class="fa fa-lock"></i> Update Password</button>
								<a href="{{ route('profile.index') }}" class="btn-secondary-link"><i class="fa fa-arrow-left"></i> Back to Profile</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function validPassword() {
	if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
		alert("New Password and Confirm Password do not match.");
		document.chngpwd.confirmpassword.focus();
		return false;
	}
	return true;
}
</script>
@endsection
