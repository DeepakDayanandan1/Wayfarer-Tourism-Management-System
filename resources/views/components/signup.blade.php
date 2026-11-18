<div class="modal fade custom-auth-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="signUpModalLabel"><i class="fa fa-user-plus"></i> Join the Wayfarer Community</h4>
				<p class="modal-subtitle">Create an account to start planning your next journey</p>
			</div>
			<div class="modal-body modal-spa">
				<div class="login-grids">
					<div class="login">
						<div class="login-right">
							<form name="signup" method="POST" action="{{ route('register.submit') }}">
								@csrf
								<div class="form-group-custom">
									<label><i class="fa fa-user"></i> Full Name</label>
									<input type="text" value="{{ old('fname') }}" placeholder="Your legal name" name="fname" class="form-control-custom" autocomplete="off" required>
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-phone"></i> Mobile Contact Number</label>
									<input type="tel" value="{{ old('mobilenumber') }}" maxlength="10" name="mobilenumber" placeholder="10-digit mobile number" class="form-control-custom" autocomplete="off" required>
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" value="{{ old('email') }}" name="email" id="signup_email" placeholder="name@example.com" class="form-control-custom" autocomplete="off" required>
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-key"></i> Choose a Password</label>
									<input type="password" name="password" placeholder="Create a secure password" class="form-control-custom" required>
								</div>
								<button type="submit" name="submit" id="submit" class="btn-auth-primary">Create Explorer Account</button>
							</form>
						</div>
						<div class="clearfix"></div>								
					</div>
					<div class="auth-switch-note">
						<p>Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal4">Sign In</a></p>
						<p class="terms-legal">By registering, you agree to our <a href="{{ route('pages.show', 'terms') }}">Terms of Service</a> &amp; <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

