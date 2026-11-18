@extends('layouts.app')

@section('title', 'Wayfarer – Sign In')
@section('body_class', 'page-signin')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Account / Sign In</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Explorer Sign In</h1>
		<p>Sign in to manage your bookings, download invoices, and view personal itineraries.</p>
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
							<h2>Welcome Back</h2>
							<p>Enter your credentials to access your account</p>
						</div>
					</div>

					<div class="account-card-body">
						@if(session('success'))
							<div class="alert alert-success" style="border-radius: 8px; margin-bottom: 20px;">
								<i class="fa fa-check-circle"></i> {{ session('success') }}
							</div>
						@endif
						@if(session('error'))
							<div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 20px;">
								<i class="fa fa-exclamation-circle"></i> {{ session('error') }}
							</div>
						@endif
						@if($errors->any())
							<div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 20px;">
								<i class="fa fa-exclamation-triangle"></i>
								<ul style="margin: 5px 0 0 15px; padding: 0;">
									@foreach($errors->all() as $err)
										<li>{{ $err }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form method="POST" action="{{ route('login.submit') }}">
							@csrf
							<div class="form-group-custom">
								<label for="login_email"><i class="fa fa-envelope-o"></i> Email Address</label>
								<input type="email" name="email" class="form-control-custom" id="login_email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
							</div>

							<div class="form-group-custom">
								<label for="login_password"><i class="fa fa-key"></i> Password</label>
								<input type="password" name="password" class="form-control-custom" id="login_password" placeholder="Enter your password" required>
							</div>

							<div class="auth-aux-links" style="margin-bottom: 20px;">
								<a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="signin" class="btn-primary-action"><i class="fa fa-sign-in"></i> Sign In to Wayfarer</button>
								<a href="{{ route('register') }}" class="btn-secondary-link"><i class="fa fa-user-plus"></i> Create Account</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
