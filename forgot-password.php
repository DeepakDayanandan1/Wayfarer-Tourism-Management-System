<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit50']))
{
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$newpassword=md5($_POST['newpassword']);
	$sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email and MobileNumber=:mobile";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update tblusers set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		$msg="Your password has been successfully reset. You can now log in.";
	}
	else {
		$error="The email address or mobile number provided does not match our records.";	
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – Recover Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
	new WOW().init();
	function valid() {
		if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
			alert("New Password and Confirm Password do not match.");
			document.chngpwd.confirmpassword.focus();
			return false;
		}
		return true;
	}
</script>
</head>
<body>
<?php include('includes/header.php');?>

<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="index.php">Home</a> / Account / Recover</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Recover Password</h1>
		<p>Verify your registered mobile number and email to securely set a new password.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3">
				<?php if($error){?><div class="custom-alert error-alert"><i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="custom-alert success-alert"><i class="fa fa-check-circle"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>

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
						<form name="chngpwd" method="post" onSubmit="return valid();">
							<div class="form-group-custom">
								<label for="recovery_email"><i class="fa fa-envelope-o"></i> Registered Email Address</label>
								<input type="email" name="email" class="form-control-custom" id="recovery_email" placeholder="name@example.com" required>
							</div>

							<div class="form-group-custom">
								<label for="recovery_mobile"><i class="fa fa-phone"></i> Registered Mobile Number</label>
								<input type="tel" name="mobile" class="form-control-custom" id="recovery_mobile" placeholder="10-digit mobile number" maxlength="10" required>
							</div>

							<div class="form-group-custom">
								<label for="newpassword"><i class="fa fa-shield"></i> New Password</label>
								<input type="password" class="form-control-custom" name="newpassword" id="newpassword" placeholder="Enter new strong password" required>
							</div>

							<div class="form-group-custom">
								<label for="confirmpassword"><i class="fa fa-check"></i> Confirm New Password</label>
								<input type="password" class="form-control-custom" name="confirmpassword" id="confirmpassword" placeholder="Re-enter new password" required>
							</div>

							<div class="form-action-wrap">
								<button type="submit" name="submit50" class="btn-primary-action"><i class="fa fa-key"></i> Reset Password</button>
								<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-secondary-link"><i class="fa fa-sign-in"></i> Back to Sign In</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('includes/footer.php');?>
<?php include('includes/signup.php');?>			
<?php include('includes/signin.php');?>			
<?php include('includes/write-us.php');?>
</body>
</html>
