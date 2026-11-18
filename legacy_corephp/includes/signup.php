<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="INSERT INTO tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are successfully registered. You can now log in.";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>
<!--Javascript for check email availabilty-->
<script>
function checkAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_availability.php",
		data:'emailid='+$("#signup_email").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
}
</script>

<div class="modal fade custom-auth-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="signUpModalLabel"><i class="fa fa-user-plus"></i> Create an Account</h4>
				<p class="modal-subtitle">Join Wayfarer for exclusive travel rates, curated tours, and personalized bookings</p>
			</div>
			<div class="modal-body modal-spa">
				<div class="login-grids">
					<div class="login">
						<div class="login-right">
							<form name="signup" method="post">
								<div class="form-group-custom">
									<label><i class="fa fa-user"></i> Full Name</label>
									<input type="text" name="fname" class="form-control-custom" placeholder="e.g. John Doe" autocomplete="name" required>
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-phone"></i> Mobile Number</label>
									<input type="tel" name="mobilenumber" maxlength="10" class="form-control-custom" placeholder="10-digit mobile number" autocomplete="tel" required>
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" name="email" id="signup_email" onBlur="checkAvailability()" class="form-control-custom" placeholder="name@example.com" autocomplete="email" required>
									<span id="user-availability-status" style="display:block; margin-top:4px; font-size:12px;"></span> 
								</div>
								<div class="form-group-custom">
									<label><i class="fa fa-lock"></i> Password</label>
									<input type="password" name="password" class="form-control-custom" placeholder="Create a secure password" autocomplete="new-password" required>
								</div>
								<button type="submit" name="submit" id="submit" class="btn-auth-primary">Create Wayfarer Account</button>
							</form>
						</div>
						<div class="clearfix"></div>								
					</div>
					<div class="auth-switch-note">
						<p>Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal4">Sign in here</a></p>
						<p class="terms-legal">By signing up, you agree to Wayfarer's <a href="page.php?type=terms">Terms and Conditions</a> &amp; <a href="page.php?type=privacy">Privacy Policy</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
