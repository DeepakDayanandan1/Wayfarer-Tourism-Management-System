<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – For people who love exploring</title>
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
<body class="page-home">
<?php include('includes/header.php');?>

<!-- Hero Section with New Stunning Image -->
<div class="banner banner-hero">
	<div class="banner-overlay"></div>
	<div class="container hero-container">
		<div class="hero-copy wow fadeInUp animated" data-wow-delay=".2s">
			<span class="hero-badge"><i class="fa fa-compass"></i> For People Who Love Exploring</span>
			<h1>Untamed Horizons,<br><span>Unforgettable Stories</span></h1>
			<p class="hero-description">Discover thoughtfully planned expeditions, breathtaking mountain landscapes, exotic coastal escapes, and unforgettable cultural journeys designed for the true explorer.</p>
			<div class="hero-action-group">
				<a class="hero-action" href="package-list.php">
					<i class="fa fa-map-o"></i> Explore Tour Packages
				</a>
				<a class="hero-secondary-action" href="enquiry.php">
					<i class="fa fa-paper-plane-o"></i> Plan Custom Trip
				</a>
			</div>
		</div>
	</div>
</div>

<!-- Features Value Proposition Strip -->
<section class="features-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".2s">
				<div class="feature-icon"><i class="fa fa-compass"></i></div>
				<div class="feature-text">
					<h4>Curated Trails</h4>
					<p>Scenic journeys &amp; hand-picked accommodations.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".3s">
				<div class="feature-icon"><i class="fa fa-shield"></i></div>
				<div class="feature-text">
					<h4>Safe &amp; Protected</h4>
					<p>Verified bookings &amp; 100% financial protection.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".4s">
				<div class="feature-icon"><i class="fa fa-binoculars"></i></div>
				<div class="feature-text">
					<h4>Expert Guides</h4>
					<p>Local specialists and 24/7 dedicated concierge.</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 feature-item wow fadeInUp animated" data-wow-delay=".5s">
				<div class="feature-icon"><i class="fa fa-tag"></i></div>
				<div class="feature-text">
					<h4>Transparent Rates</h4>
					<p>Honest pricing with no hidden tourist markups.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Featured Packages Section -->
<section class="holiday-section">
	<div class="container">
		<div class="section-header wow fadeInDown animated" data-wow-delay=".2s">
			<span class="section-tag">Curated Expeditions</span>
			<h2>Trending Travel Experiences</h2>
			<p>Hand-picked itineraries loved by adventurous travelers, couples, and wandering families.</p>
		</div>

		<div class="packages-grid">
<?php 
$sql = "SELECT * from tbltourpackages order by rand() limit 4";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
			<div class="package-card wow fadeInUp animated" data-wow-delay=".3s">
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
							<span class="price-label">Starting from</span>
							<span class="package-price">&#8377; <?php echo number_format($result->PackagePrice);?></span>
						</div>
						<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="btn-view-details">
							View Details <i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
<?php }} ?>
		</div>

		<div class="view-all-wrapper wow fadeInUp animated" data-wow-delay=".4s">
			<a href="package-list.php" class="btn-view-all">
				Browse All Packages <i class="fa fa-long-arrow-right"></i>
			</a>
		</div>
	</div>
</section>

<!-- Trust & Stats Counter -->
<section class="routes-section">
	<div class="container">
		<div class="row stats-row">
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".2s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-compass"></i></div>
					<div class="stat-content">
						<h3>80,000+</h3>
						<p>Inquiries Answered</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".3s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-users"></i></div>
					<div class="stat-content">
						<h3>1,900+</h3>
						<p>Active Wayfarers</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 stat-col wow fadeInUp animated" data-wow-delay=".4s">
				<div class="stat-card">
					<div class="stat-icon-wrap"><i class="fa fa-globe"></i></div>
					<div class="stat-content">
						<h3>7,00,000+</h3>
						<p>Miles Explored</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Call to Action Banner -->
<section class="cta-banner-section">
	<div class="container">
		<div class="cta-banner-inner wow zoomIn animated" data-wow-delay=".2s">
			<div class="cta-content">
				<span class="cta-subtitle">Start Your Expedition</span>
				<h2>Ready to explore uncharted horizons with Wayfarer?</h2>
				<p>Let our experienced travel curators build an expedition customized to your pace, style, and wanderlust.</p>
				<div class="cta-buttons">
					<a href="enquiry.php" class="btn-cta-primary"><i class="fa fa-paper-plane"></i> Plan My Custom Trip</a>
					<a href="package-list.php" class="btn-cta-secondary"><i class="fa fa-compass"></i> Browse All Tours</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('includes/footer.php');?>
<?php include('includes/signup.php');?>			
<?php include('includes/signin.php');?>			
<?php include('includes/write-us.php');?>			
</body>
</html>
