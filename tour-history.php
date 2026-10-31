<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{	
	header('location:index.php');
	exit;
}
else {
if(isset($_REQUEST['bkid']))
{
	$bid=intval($_GET['bkid']);
	$email=$_SESSION['login'];
	$sql ="SELECT FromDate FROM tblbooking WHERE UserEmail=:email and BookingId=:bid";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':bid', $bid, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
			$fdate=$result->FromDate;
			$cdate=date('Y-m-d');
			$date1=date_create("$cdate");
			$date2=date_create("$fdate");
			$diff=date_diff($date1,$date2);
			$df=$diff->format("%r%a");
			if($df > 1)
			{
				$status=2;
				$cancelby='u';
				$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE UserEmail=:email and BookingId=:bid";
				$query = $dbh->prepare($sql);
				$query -> bindParam(':status',$status, PDO::PARAM_STR);
				$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
				$query -> bindParam(':email',$email, PDO::PARAM_STR);
				$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
				$query -> execute();
				$msg="Booking cancelled successfully.";
			}
			else
			{
				$error="You cannot cancel a booking within 24 hours of departure.";
			}
		}
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – My Tour History</title>
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
		<span class="banner-crumb"><a href="index.php">Home</a> / Dashboard / History</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">My Tour History</h1>
		<p>Track your past journeys, view current reservations, and manage booking confirmations.</p>
	</div>
</div>

<div class="dashboard-page-section">
	<div class="container">
		<?php if($error){?><div class="custom-alert error-alert"><i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?php echo htmlentities($error); ?> </div><?php } 
		else if($msg){?><div class="custom-alert success-alert"><i class="fa fa-check-circle"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>

		<div class="dashboard-card wow fadeInUp animated" data-wow-delay=".2s">
			<div class="dashboard-card-header">
				<div class="header-titles">
					<h2><i class="fa fa-suitcase"></i> All Reservations</h2>
					<p>Below is your complete booking itinerary record registered with <?php echo htmlentities($_SESSION['login']); ?>.</p>
				</div>
				<a href="package-list.php" class="btn-book-new"><i class="fa fa-plus"></i> Book Another Tour</a>
			</div>

			<div class="table-responsive custom-table-wrap">
				<table class="table custom-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Booking ID</th>
							<th>Tour Package</th>
							<th>Departure</th>
							<th>Return</th>
							<th>Special Notes</th>
							<th>Status</th>
							<th>Booked On</th>
							<th class="text-right">Action</th>
						</tr>
					</thead>
					<tbody>
<?php 
$uemail=$_SESSION['login'];
$sql = "SELECT tblbooking.BookingId as bookid,tblbooking.PackageId as pkgid,tbltourpackages.PackageName as packagename,tblbooking.FromDate as fromdate,tblbooking.ToDate as todate,tblbooking.Comment as comment,tblbooking.status as status,tblbooking.RegDate as regdate,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate from tblbooking join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId where UserEmail=:uemail ORDER BY tblbooking.BookingId DESC";
$query = $dbh->prepare($sql);
$query -> bindParam(':uemail', $uemail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
						<tr>
							<td><span class="row-num"><?php echo htmlentities($cnt);?></span></td>
							<td><strong class="booking-ref">#BK-<?php echo htmlentities($result->bookid);?></strong></td>
							<td>
								<a class="package-link" href="package-details.php?pkgid=<?php echo htmlentities($result->pkgid);?>">
									<?php echo htmlentities($result->packagename);?>
								</a>
							</td>
							<td><span class="date-badge"><i class="fa fa-calendar-o"></i> <?php echo htmlentities($result->fromdate);?></span></td>
							<td><span class="date-badge"><i class="fa fa-calendar-check-o"></i> <?php echo htmlentities($result->todate);?></span></td>
							<td class="comment-cell"><?php echo htmlentities($result->comment ?: 'None'); ?></td>
							<td>
<?php 
if($result->status==0) {
	echo '<span class="status-pill status-pending"><i class="fa fa-clock-o"></i> Pending</span>';
} else if($result->status==1) {
	echo '<span class="status-pill status-confirmed"><i class="fa fa-check"></i> Confirmed</span>';
} else if($result->status==2) {
	if($result->cancelby=='u') {
		echo '<span class="status-pill status-cancelled"><i class="fa fa-times"></i> Cancelled by You</span>';
	} else {
		echo '<span class="status-pill status-cancelled"><i class="fa fa-times"></i> Cancelled by Admin</span>';
	}
}
?>
							</td>
							<td class="text-muted text-sm"><?php echo date('M d, Y', strtotime($result->regdate));?></td>
							<td class="text-right">
<?php if($result->status==2) { ?>
								<span class="action-disabled">Closed</span>
<?php } else { ?>
								<a href="tour-history.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Are you sure you wish to cancel this reservation?');" class="btn-cancel-booking">
									<i class="fa fa-ban"></i> Cancel
								</a>
<?php } ?>
							</td>
						</tr>
<?php $cnt=$cnt+1; }} else { ?>
						<tr>
							<td colspan="9" class="text-center empty-state-cell">
								<div class="empty-state">
									<i class="fa fa-calendar-times-o"></i>
									<h4>No reservations found</h4>
									<p>You haven't booked any tours yet. Find your dream getaway from our curated packages!</p>
									<a href="package-list.php" class="btn-primary-action">Explore Packages</a>
								</div>
							</td>
						</tr>
<?php } ?>
					</tbody>
				</table>
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
<?php } ?>
