<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer | Admin Password Recovery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap Core CSS -->
<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/font-awesome.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
	font-family: 'Plus Jakarta Sans', sans-serif;
	background: #090e17 url('{{ asset('images/3333333.jpg') }}') no-repeat center center / cover fixed !important;
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	margin: 0;
	padding: 20px;
}
.admin-login-overlay {
	position: fixed;
	inset: 0;
	background: rgba(9, 14, 23, 0.78);
	backdrop-filter: blur(8px);
	z-index: 1;
}
.admin-card-wrap {
	position: relative;
	z-index: 2;
	width: 100%;
	max-width: 440px;
}
.admin-card {
	background: rgba(255, 255, 255, 0.98);
	border-radius: 20px;
	padding: 40px;
	box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
	border: 1px solid rgba(255, 255, 255, 0.3);
}
.admin-card-brand {
	text-align: center;
	margin-bottom: 24px;
}
.admin-card-brand i {
	font-size: 38px;
	color: #ff5e3a;
	margin-bottom: 10px;
	display: inline-block;
}
.admin-card-brand h2 {
	margin: 0;
	font-size: 24px;
	font-weight: 700;
	color: #0f172a;
}
.admin-card-brand p {
	font-size: 13px;
	color: #64748b;
	margin: 4px 0 0 0;
}
.admin-field-group {
	margin-bottom: 18px;
}
.admin-field-group label {
	display: block;
	font-size: 13px;
	font-weight: 600;
	color: #334155;
	margin-bottom: 6px;
}
.admin-field-group input {
	width: 100%;
	padding: 11px 14px;
	border: 1px solid #cbd5e1;
	border-radius: 10px;
	font-size: 14px;
	color: #0f172a;
	outline: none;
	background: #ffffff;
}
.admin-field-group input:focus {
	border-color: #ff5e3a;
	box-shadow: 0 0 0 3px rgba(255, 94, 58, 0.2);
}
.btn-admin-submit {
	width: 100%;
	background: #ff5e3a;
	color: #ffffff;
	border: none;
	border-radius: 10px;
	padding: 13px;
	font-size: 15px;
	font-weight: 700;
	cursor: pointer;
	box-shadow: 0 6px 16px rgba(255, 94, 58, 0.3);
}
.btn-admin-submit:hover {
	background: #e04b28;
}
.admin-card-footer {
	text-align: center;
	margin-top: 20px;
	padding-top: 16px;
	border-top: 1px solid #e2e8f0;
}
.admin-card-footer a {
	color: #64748b;
	font-size: 13px;
	text-decoration: none;
}
.admin-card-footer a:hover {
	color: #ff5e3a;
}
.admin-alert-danger {
	background: #fee2e2;
	color: #991b1b;
	border: 1px solid #fecaca;
	padding: 10px 14px;
	border-radius: 8px;
	margin-bottom: 16px;
	font-size: 13px;
}
</style>
</head>
<body>
<div class="admin-login-overlay"></div>

<div class="admin-card-wrap">
	<div class="admin-card">
		<div class="admin-card-brand">
			<i class="fa fa-key"></i>
			<h2>Recover Admin Access</h2>
			<p>Verify admin credentials to reset password</p>
		</div>

		@if($errors->any())
			<div class="admin-alert-danger">
				<i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}
			</div>
		@endif

		<form method="POST" action="{{ route('admin.forgot.password.submit') }}">
			@csrf
			<div class="admin-field-group">
				<label><i class="fa fa-envelope-o"></i> Admin Email</label>
				<input type="email" name="email" value="{{ old('email') }}" placeholder="admin@wayfarer.com" required autofocus>
			</div>

			<div class="admin-field-group">
				<label><i class="fa fa-phone"></i> Mobile Number (10 digits)</label>
				<input type="tel" name="mobile" maxlength="10" value="{{ old('mobile') }}" placeholder="10-digit number" required>
			</div>

			<div class="admin-field-group">
				<label><i class="fa fa-lock"></i> New Password</label>
				<input type="password" name="new_password" placeholder="Create strong password" required minlength="4">
			</div>

			<div class="admin-field-group">
				<label><i class="fa fa-check"></i> Confirm New Password</label>
				<input type="password" name="new_password_confirmation" placeholder="Repeat new password" required minlength="4">
			</div>

			<button type="submit" class="btn-admin-submit">
				<i class="fa fa-refresh"></i> Reset Password
			</button>
		</form>

		<div class="admin-card-footer">
			<a href="{{ route('admin.login') }}"><i class="fa fa-arrow-left"></i> Back to Admin Login</a>
		</div>
	</div>
</div>
</body>
</html>
