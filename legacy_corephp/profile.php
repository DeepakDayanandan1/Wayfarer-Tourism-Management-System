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
if(isset($_POST['submit6']))
{
	$name=$_POST['name'];
	$mobileno=$_POST['mobileno'];
	$email=$_SESSION['login'];

	$sql="update tblusers set FullName=:name,MobileNumber=:mobileno where EmailId=:email";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name',$name,PDO::PARAM_STR);
	$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->execute();
	$msg="Profile details updated successfully.";
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer – My Profile</title>
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
		<span class="banner-crumb"><a href="index.php">Home</a> / Account / Profile</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">My Profile</h1>
		<p>Manage your account settings, personal details, and travel contact preferences.</p>
	</div>
</div>

<div class="account-page-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-md-offset-2">
				<?php if($error){?><div class="custom-alert error-alert"><i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="custom-alert success-alert"><i class="fa fa-check-circle"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php }?>

				<div class="account-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="account-card-header">
						<div class="user-avatar-badge">
							<i class="fa fa-user"></i>
						</div>
						<div class="user-header-info">
							<h2>Personal Information</h2>
							<p>Logged in as <strong><?php echo htmlentities($_SESSION['login']); ?></strong></p>
						</div>
					</div>

					<div class="account-card-body">
						<form name="chngpwd" method="post">
<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
							<div class="form-group-custom">
								<label for="name"><i class="fa fa-user-o"></i> Full Name</label>
								<input type="text" name="name" value="<?php echo htmlentities($result->FullName);?>" class="form-control-custom" id="name" placeholder="Your full name" required>
							</div> 

							<div class="form-group-custom">
								<label for="mobileno"><i class="fa fa-phone"></i> Mobile Contact Number</label>
								<input type="tel" class="form-control-custom" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber);?>" id="mobileno" placeholder="10-digit mobile number" required>
							</div>

							<div class="form-group-custom">
								<label for="email"><i class="fa fa-envelope-o"></i> Email Address (Account ID)</label>
								<input type="email" class="form-control-custom readonly-input" name="email" value="<?php echo htmlentities($result->EmailId);?>" id="email" readonly>
								<small class="field-help-text">Email address is tied to your login identity and cannot be altered.</small>
							</div>

							<div class="row meta-dates-row">
								<div class="col-sm-6 meta-date-item">
									<label><i class="fa fa-calendar-check-o"></i> Registered Since</label>
									<p><?php echo date('M d, Y', strtotime($result->RegDate));?></p>
								</div>
								<div class="col-sm-6 meta-date-item">
									<label><i class="fa fa-history"></i> Last Profile Update</label>
									<p><?php echo $result->UpdationDate ? date('M d, Y H:i', strtotime($result->UpdationDate)) : 'Not updated yet'; ?></p>
								</div>
							</div>

<?php }} ?>
							<div class="form-action-wrap">
								<button type="submit" name="submit6" class="btn-primary-action"><i class="fa fa-save"></i> Save Profile Changes</button>
								<a href="change-password.php" class="btn-secondary-link"><i class="fa fa-key"></i> Change Password</a>
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
<?php } ?>
