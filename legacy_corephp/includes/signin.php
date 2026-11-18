<?php
session_start();
if(isset($_POST['signin']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
} else{
	echo "<script>alert('Invalid Email or Password');</script>";
}
}
?>

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
							<form method="post">
								<div class="form-group-custom">
									<label><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" name="email" id="email" class="form-control-custom" placeholder="name@example.com" required autocomplete="email">
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-key"></i> Password</label>
									<input type="password" name="password" id="password" class="form-control-custom" placeholder="Enter your password" required autocomplete="current-password">
								</div>
								<div class="auth-aux-links">
									<a href="forgot-password.php" class="forgot-link">Forgot password?</a>
								</div>
								<button type="submit" name="signin" class="btn-auth-primary">Sign In to Wayfarer</button>
							</form>
						</div>
						<div class="clearfix"></div>								
					</div>
					<div class="auth-switch-note">
						<p>Don't have an account yet? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal">Create one now</a></p>
						<p class="terms-legal">By signing in, you agree to our <a href="page.php?type=terms">Terms of Service</a> &amp; <a href="page.php?type=privacy">Privacy Policy</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
