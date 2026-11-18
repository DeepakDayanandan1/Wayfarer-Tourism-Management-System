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
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – Raised Support Tickets</title>
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
		<span class="banner-crumb"><a href="index.php">Home</a> / Dashboard / Tickets</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Raised Support Tickets</h1>
		<p>Track the status of your concierge inquiries, cancellation requests, and administrator remarks.</p>
	</div>
</div>

<div class="dashboard-page-section">
	<div class="container">
		<div class="dashboard-card wow fadeInUp animated" data-wow-delay=".2s">
			<div class="dashboard-card-header">
				<div class="header-titles">
					<h2><i class="fa fa-ticket"></i> Support History</h2>
					<p>Inquiries registered under <strong><?php echo htmlentities($_SESSION['login']); ?></strong></p>
				</div>
				<a href="#" data-toggle="modal" data-target="#myModal3" class="btn-book-new"><i class="fa fa-plus"></i> Submit New Ticket</a>
			</div>

			<div class="table-responsive custom-table-wrap">
				<table class="table custom-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Ticket Ref</th>
							<th>Category</th>
							<th>Your Inquiry</th>
							<th>Concierge Remark</th>
							<th>Submitted Date</th>
							<th>Resolution Date</th>
						</tr>
					</thead>
					<tbody>
<?php 
$uemail=$_SESSION['login'];
$sql = "SELECT * from tblissues where UserEmail=:uemail ORDER BY id DESC";
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
							<td><strong class="booking-ref">#TKT-<?php echo htmlentities($result->id);?></strong></td>
							<td><span class="category-badge"><i class="fa fa-tag"></i> <?php echo htmlentities($result->Issue);?></span></td>
							<td class="comment-cell"><?php echo htmlentities($result->Description);?></td>
							<td>
<?php if($result->AdminRemark) { ?>
								<div class="admin-remark-box">
									<i class="fa fa-comment"></i> <?php echo htmlentities($result->AdminRemark);?>
								</div>
<?php } else { ?>
								<span class="status-pill status-pending"><i class="fa fa-clock-o"></i> Under Review</span>
<?php } ?>
							</td>
							<td class="text-muted text-sm"><?php echo date('M d, Y', strtotime($result->PostingDate));?></td>
							<td class="text-muted text-sm"><?php echo $result->AdminremarkDate ? date('M d, Y', strtotime($result->AdminremarkDate)) : 'Pending'; ?></td>
						</tr>
<?php $cnt=$cnt+1; }} else { ?>
						<tr>
							<td colspan="7" class="text-center empty-state-cell">
								<div class="empty-state">
									<i class="fa fa-check-circle-o"></i>
									<h4>No support tickets found</h4>
									<p>Have an inquiry about a trip, refund, or booking? Our team is always ready to assist.</p>
									<a href="#" data-toggle="modal" data-target="#myModal3" class="btn-primary-action">Submit Ticket</a>
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
