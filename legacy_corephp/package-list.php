<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – For people who love exploring | Tour Packages</title>
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

<!-- Page Banner -->
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="index.php">Home</a> / Packages</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Explore Tour Packages</h1>
		<p>Hand-picked journeys, cultural immersions, and breathtaking holiday getaways.</p>
	</div>
</div>

<!-- Package List -->
<div class="packages-page-section">
	<div class="container">
		<div class="package-list-topbar">
<?php
$countSql = "SELECT COUNT(*) as total from tbltourpackages";
$countQuery = $dbh->query($countSql);
$totalPackages = $countQuery->fetchColumn();
?>
			<div class="list-count-info">
				<h3>Available Experiences (<?php echo $totalPackages; ?>)</h3>
				<p>All packages include verified accommodations, dedicated guide support, and standard amenities.</p>
			</div>
		</div>

		<div class="packages-grid">
<?php 
$sql = "SELECT * from tbltourpackages ORDER BY PackageId ASC";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
			<div class="package-card wow fadeInUp animated" data-wow-delay=".2s">
				<div class="package-card-inner">
					<div class="package-thumb">
						<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" alt="<?php echo htmlentities($result->PackageName);?>">
						<span class="package-type-badge"><?php echo htmlentities($result->PackageType);?></span>
					</div>
					<div class="package-body">
						<div class="package-location">
							<i class="fa fa-map-marker"></i> <?php echo htmlentities($result->PackageLocation);?>
						</div>
						<h3 class="package-title">
							<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>">
								<?php echo htmlentities($result->PackageName);?>
							</a>
						</h3>
						<p class="package-features">
							<i class="fa fa-check-circle"></i> <?php echo htmlentities($result->PackageFetures);?>
						</p>
					</div>
					<div class="package-footer">
						<div class="package-price-wrap">
							<span class="price-label">Price per person</span>
							<span class="package-price">&#8377; <?php echo number_format($result->PackagePrice);?></span>
						</div>
						<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="btn-view-details">
							View Itinerary <i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
<?php }} ?>
		</div>
	</div>
</div>

<?php include('includes/footer.php');?>
<?php include('includes/signup.php');?>			
<?php include('includes/signin.php');?>			
<?php include('includes/write-us.php');?>			
</body>
</html>
