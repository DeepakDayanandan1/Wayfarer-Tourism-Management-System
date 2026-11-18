<div class="modal fade custom-auth-modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="signInModalLabel"><i class="fa fa-lock"></i> Welcome Back</h4>
				<p class="modal-subtitle">Sign in to manage your bookings and view personal itineraries</p>
			</div>
			<div class="modal-body modal-spa">
				<div class="login-grids">
					<div class="login">
						<div class="login-right">
							@if($errors->has('email') || $errors->has('password'))
								<div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 15px; font-size: 13px; padding: 10px 15px;">
									<i class="fa fa-exclamation-circle"></i> {{ $errors->first('email') ?: $errors->first('password') }}
								</div>
							@endif

							<form method="POST" action="{{ route('login.submit') }}">
								@csrf
								<div class="form-group-custom">
									<label><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" name="email" id="signin_email" class="form-control-custom" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-key"></i> Password</label>
									<input type="password" name="password" id="signin_password" class="form-control-custom" placeholder="Enter your password" required autocomplete="current-password">
								</div>
								<div class="auth-aux-links">
									<a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
								</div>
								<button type="submit" name="signin" class="btn-auth-primary">Sign In to Wayfarer</button>
							</form>
						</div>
						<div class="clearfix"></div>								
					</div>
					<div class="auth-switch-note">
						<p>Don't have an account yet? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Create one now</a></p>
						<p class="terms-legal">By signing in, you agree to our <a href="{{ route('pages.show', 'terms') }}">Terms of Service</a> &amp; <a href="{{ route('pages.show', 'privacy') }}">Privacy Policy</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

