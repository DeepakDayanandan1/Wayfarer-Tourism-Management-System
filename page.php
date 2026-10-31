<?php
session_start();
error_reporting(0);
include('includes/config.php');

$pagetype = isset($_GET['type']) ? $_GET['type'] : 'aboutus';

// Map page type to human-friendly titles
$pageTitles = [
	'aboutus' => 'About Wayfarer',
	'terms' => 'Terms of Service',
	'privacy' => 'Privacy Policy',
	'contact' => 'Contact Information'
];

$pageSubtitles = [
	'aboutus' => 'Crafting memorable, bespoke, and seamless journeys across the globe for explorers.',
	'terms' => 'Please review our guidelines and operational terms governing reservations.',
	'privacy' => 'How we collect, protect, and respect your personal information.',
	'contact' => 'Get in touch with our global customer concierge and travel specialists.'
];

$currentTitle = isset($pageTitles[$pagetype]) ? $pageTitles[$pagetype] : ucfirst($pagetype);
$currentSubtitle = isset($pageSubtitles[$pagetype]) ? $pageSubtitles[$pagetype] : 'Official Wayfarer Information';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer | <?php echo htmlentities($currentTitle); ?></title>
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
		<span class="banner-crumb"><a href="index.php">Home</a> / <?php echo htmlentities($currentTitle); ?></span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s"><?php echo htmlentities($currentTitle); ?></h1>
		<p><?php echo htmlentities($currentSubtitle); ?></p>
	</div>
</div>

<div class="editorial-page-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="editorial-card wow fadeInUp animated" data-wow-delay=".2s">
<?php 
$sql = "SELECT type,detail from tblpages where type=:pagetype";
$query = $dbh -> prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{		
?>
					<div class="editorial-content">
						<?php echo $result->detail; ?>
					</div>
<?php }} else { ?>
					<div class="empty-state">
						<p>Information for this section is currently being updated. Please check back shortly.</p>
					</div>
<?php } ?>
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
