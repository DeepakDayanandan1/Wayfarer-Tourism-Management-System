<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$useremail=$_SESSION['login'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$comment=$_POST['comment'];
$status=0;
$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booking request submitted successfully! Check your tour history for status updates.";
}
else 
{
$error="Something went wrong while processing your booking. Please try again.";
}

}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – Tour Package Details</title>
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

<!-- Inner Page Banner -->
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="index.php">Home</a> / <a href="package-list.php">Packages</a> / Details</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Package Details &amp; Booking</h1>
		<p>Review comprehensive trip highlights, inclusions, and reserve your departure date.</p>
	</div>
</div>

<div class="details-page-section">
	<div class="container">	
		<?php if($error){?><div class="custom-alert error-alert"><i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?php echo htmlentities($error); ?> </div><?php } 
		else if($msg){?><div class="custom-alert success-alert"><i class="fa fa-check-circle"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>

<?php 
$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
		<form name="book" method="post">
			<div class="row details-layout-row">
				<!-- Left Column: Package Highlights & Description -->
				<div class="col-md-7 col-lg-8 details-left-col wow fadeInLeft animated" data-wow-delay=".2s">
					<div class="package-hero-card">
						<div class="package-hero-img-wrap">
							<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" alt="<?php echo htmlentities($result->PackageName);?>" class="img-responsive">
							<span class="package-hero-type"><i class="fa fa-tag"></i> <?php echo htmlentities($result->PackageType);?></span>
						</div>
						<div class="package-hero-meta">
							<span class="pkg-code">ID: #PKG-<?php echo htmlentities($result->PackageId);?></span>
							<h2><?php echo htmlentities($result->PackageName);?></h2>
							<div class="pkg-location">
								<i class="fa fa-map-marker"></i> <span><?php echo htmlentities($result->PackageLocation);?></span>
							</div>
						</div>
					</div>

					<div class="package-content-block">
						<h3><i class="fa fa-list-ul"></i> Package Features &amp; Inclusions</h3>
						<div class="package-features-box">
							<p><?php echo htmlentities($result->PackageFetures);?></p>
						</div>
					</div>

					<div class="package-content-block">
						<h3><i class="fa fa-file-text-o"></i> Overview &amp; Experience Highlights</h3>
						<div class="package-description-box">
							<p><?php echo nl2br(htmlentities($result->PackageDetails));?></p>
						</div>
					</div>

					<div class="package-content-block trust-strip">
						<div class="row">
							<div class="col-sm-4 trust-item">
								<i class="fa fa-check-square-o"></i>
								<strong>Instant Confirmation</strong>
								<span>Fast booking verification</span>
							</div>
							<div class="col-sm-4 trust-item">
								<i class="fa fa-calendar-check-o"></i>
								<strong>Flexible Dates</strong>
								<span>Custom departures available</span>
							</div>
							<div class="col-sm-4 trust-item">
								<i class="fa fa-shield"></i>
								<strong>Best Price Guarantee</strong>
								<span>No hidden surcharge</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column: Sticky Reservation Box -->
				<div class="col-md-5 col-lg-4 details-right-col wow fadeInRight animated" data-wow-delay=".3s">
					<div class="booking-card-sticky">
						<div class="booking-card-header">
							<span class="book-card-label">Total Package Price</span>
							<div class="booking-price">
								<span class="currency">&#8377;</span>
								<span class="amount"><?php echo number_format($result->PackagePrice);?></span>
								<span class="per-unit">/ person</span>
							</div>
						</div>

						<div class="booking-card-body">
							<div class="form-group-custom">
								<label for="datepicker2"><i class="fa fa-calendar"></i> Departure Date (From)</label>
								<input class="form-control-custom date-input" id="datepicker2" type="date" name="fromdate" required>
							</div>

							<div class="form-group-custom">
								<label for="datepicker3"><i class="fa fa-calendar"></i> Return Date (To)</label>
								<input class="form-control-custom date-input" id="datepicker3" type="date" name="todate" required>
							</div>

							<div class="form-group-custom">
								<label for="comment"><i class="fa fa-commenting-o"></i> Special Requests or Notes</label>
								<textarea class="form-control-custom" id="comment" name="comment" rows="3" placeholder="Tell us about dietary preferences, airport pickup, or special requests..." required></textarea>
							</div>

							<div class="booking-cta-wrap">
								<?php if($_SESSION['login']) { ?>
									<button type="submit" name="submit2" class="btn-book-now">
										<i class="fa fa-check"></i> Complete Reservation
									</button>
								<?php } else { ?>
									<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-book-now">
										<i class="fa fa-sign-in"></i> Sign In to Reserve
									</a>
									<span class="guest-book-hint">You need an active account to book a tour.</span>
								<?php } ?>
							</div>

							<div class="booking-guarantee-note">
								<i class="fa fa-lock"></i> Secure SSL Checkout. You will not be charged until confirmed.
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
<?php }} ?>
	</div>
</div>

<?php include('includes/footer.php');?>
<?php include('includes/signup.php');?>			
<?php include('includes/signin.php');?>			
<?php include('includes/write-us.php');?>

<script>
  // Ensure minimum selectable date is today
  const today = new Date().toISOString().split("T")[0];
  const fromEl = document.getElementById("datepicker2");
  const toEl = document.getElementById("datepicker3");
  if(fromEl) {
    fromEl.setAttribute("min", today);
    fromEl.addEventListener("change", function() {
      if(toEl) toEl.setAttribute("min", this.value);
    });
  }
  if(toEl) {
    toEl.setAttribute("min", today);
  }
</script>
</body>
</html>
