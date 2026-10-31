<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit1']))
{
$fname=$_POST['fname'];
$email=$_POST['email'];	
$mobile=$_POST['mobileno'];
$subject=$_POST['subject'];	
$description=$_POST['description'];
$sql="INSERT INTO tblenquiry(FullName,EmailId,MobileNumber,Subject,Description) VALUES(:fname,:email,:mobile,:subject,:description)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Your inquiry has been submitted successfully! Our travel concierge will reach out to you within 24 hours.";
}
else 
{
$error="Something went wrong while submitting your inquiry. Please try again.";
}

}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – Custom Travel Enquiry</title>
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
		<span class="banner-crumb"><a href="index.php">Home</a> / Contact / Enquiry</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Send an Enquiry</h1>
		<p>Plan a bespoke holiday, customize an existing tour, or request special corporate packages.</p>
	</div>
</div>

<div class="enquiry-page-section">
	<div class="container">
		<?php if($error){?><div class="custom-alert error-alert"><i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?php echo htmlentities($error); ?> </div><?php } 
		else if($msg){?><div class="custom-alert success-alert"><i class="fa fa-check-circle"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>

		<div class="row enquiry-layout-row">
			<!-- Contact Information Cards -->
			<div class="col-md-5 enquiry-info-col wow fadeInLeft animated" data-wow-delay=".2s">
				<div class="enquiry-info-box">
					<span class="info-tag">Concierge Desk</span>
					<h3>We're here to make your journey effortless.</h3>
					<p>Whether you're organizing a solo trek, luxury honeymoon, or group excursion, our travel advisors are ready to craft the perfect itinerary.</p>
					
					<div class="contact-channels">
						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-phone"></i></div>
							<div class="channel-details">
								<strong>Toll-Free Helpline</strong>
								<span>123-4568790 / +91 98765 43210</span>
								<small>Mon - Sat: 9:00 AM - 8:00 PM IST</small>
							</div>
						</div>

						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-envelope-o"></i></div>
							<div class="channel-details">
								<strong>Email Concierge</strong>
								<span>concierge@wayfarer.com</span>
								<small>Average response time: 2 hours</small>
							</div>
						</div>

						<div class="channel-card">
							<div class="channel-icon"><i class="fa fa-map-marker"></i></div>
							<div class="channel-details">
								<strong>Headquarters</strong>
								<span>Wayfarer Expeditions House, Dwarka Sector 12, New Delhi 110096</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Form Card -->
			<div class="col-md-7 enquiry-form-col wow fadeInRight animated" data-wow-delay=".3s">
				<div class="enquiry-form-card">
					<div class="form-header">
						<h3>Submit Trip Inquiry</h3>
						<p>Fill out the details below and we will tailor options to your schedule and budget.</p>
					</div>

					<form name="enquiry" method="post">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="fname"><i class="fa fa-user-o"></i> Full Name</label>
									<input type="text" name="fname" class="form-control-custom" id="fname" placeholder="e.g. Eleanor Vance" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="email"><i class="fa fa-envelope-o"></i> Email Address</label>
									<input type="email" name="email" class="form-control-custom" id="email" placeholder="name@example.com" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="mobileno"><i class="fa fa-phone"></i> Mobile Number</label>
									<input type="tel" name="mobileno" class="form-control-custom" id="mobileno" maxlength="10" placeholder="10-digit mobile number" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group-custom">
									<label for="subject"><i class="fa fa-tag"></i> Subject / Interest</label>
									<input type="text" name="subject" class="form-control-custom" id="subject" placeholder="e.g. Custom Switzerland Family Tour" required>
								</div>
							</div>
						</div>

						<div class="form-group-custom">
							<label for="description"><i class="fa fa-pencil"></i> Detailed Requirements &amp; Preferred Dates</label>
							<textarea name="description" class="form-control-custom" rows="5" id="description" placeholder="Share your destination preferences, number of travelers, budget estimate, or special requests..." required></textarea>
						</div>

						<div class="form-submit-wrap">
							<button type="submit" name="submit1" class="btn-primary-action"><i class="fa fa-paper-plane"></i> Send Travel Inquiry</button>
						</div>
					</form>
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
