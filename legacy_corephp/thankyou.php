<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – Confirmation</title>
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
</script>
</head>
<body>
<?php include('includes/header.php');?>

<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="index.php">Home</a> / Confirmation</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Confirmation</h1>
		<p>Thank you for connecting with KindConnect.</p>
	</div>
</div>

<div class="confirmation-page-section">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="confirmation-card wow zoomIn animated" data-wow-delay=".3s">
					<div class="confirm-icon-wrap">
						<i class="fa fa-check-circle"></i>
					</div>
					<h2>Request Received</h2>
					<p class="confirm-message">
						<?php 
						if($_SESSION['msg']) {
							echo htmlentities($_SESSION['msg']);
							unset($_SESSION['msg']);
						} else {
							echo "Your action has been processed successfully.";
						}
						?>
					</p>
					<div class="confirm-actions">
						<?php if($_SESSION['login']) { ?>
							<a href="package-list.php" class="btn-primary-action"><i class="fa fa-compass"></i> Explore Tour Packages</a>
							<a href="tour-history.php" class="btn-secondary-link"><i class="fa fa-history"></i> View My History</a>
						<?php } else { ?>
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary-action"><i class="fa fa-sign-in"></i> Sign In to Account</a>
							<a href="index.php" class="btn-secondary-link"><i class="fa fa-home"></i> Back to Homepage</a>
						<?php } ?>
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
