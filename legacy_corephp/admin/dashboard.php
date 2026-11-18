<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
	exit;
}
else{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer | Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
<!--header start here-->
<?php include('includes/header.php');?>
<!--header end here-->
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> <span>Dashboard</span></li>
        </ol>

		<!-- Overview Row -->
		<div class="four-grids">
			<div class="col-md-4 four-grid">
				<a href="manage-users.php">
					<div class="four-agileits">
						<div class="icon">
							<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Total Users</h3>
							<?php 
							$sql = "SELECT id from tblusers";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=$query->rowCount();
							?>
							<h4><?php echo htmlentities($cnt);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4 four-grid">
				<a href="manageissues.php">
					<div class="four-w3ls">
						<div class="icon">
							<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Issues Raised</h3>
							<?php 
							$sql5 = "SELECT id from tblissues";
							$query5= $dbh -> prepare($sql5);
							$query5->execute();
							$results5=$query5->fetchAll(PDO::FETCH_OBJ);
							$cnt5=$query5->rowCount();
							?>
							<h4><?php echo htmlentities($cnt5);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4 four-grid">
				<a href="manage-packages.php">
					<div class="four-wthree">
						<div class="icon">
							<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Total Packages</h3>
							<?php 
							$sql3 = "SELECT PackageId from tbltourpackages";
							$query3= $dbh -> prepare($sql3);
							$query3->execute();
							$results3=$query3->fetchAll(PDO::FETCH_OBJ);
							$cnt3=$query3->rowCount();
							?>
							<h4><?php echo htmlentities($cnt3);?></h4>
						</div>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<!-- Enquiries Row -->
		<div class="four-grids">
			<div class="col-md-4 four-grid">
				<a href="manage-enquires.php">
					<div class="four-agileinfo">
						<div class="icon">
							<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Total Enquiries</h3>
							<?php 
							$sql2 = "SELECT id from tblenquiry";
							$query2= $dbh -> prepare($sql2);
							$query2->execute();
							$results2=$query2->fetchAll(PDO::FETCH_OBJ);
							$cnt2=$query2->rowCount();
							?>
							<h4><?php echo htmlentities($cnt2);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4 four-grid">
				<a href="manage-enquires.php">
					<div class="four-agileits">
						<div class="icon">
							<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>New Enquiries</h3>
							<?php 
							$sql ="SELECT id from tblenquiry where (Status is null || Status='')";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$newenq=$query->rowCount();
							?>
							<h4><?php echo htmlentities($newenq);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-4 four-grid">
				<a href="manage-enquires.php">
					<div class="four-w3ls">
						<div class="icon">
							<i class="glyphicon glyphicon-check" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Read Enquiries</h3>
							<?php 
							$sql5 ="SELECT id from tblenquiry where (Status='1')";
							$query5= $dbh -> prepare($sql5);
							$query5->execute();
							$results5=$query5->fetchAll(PDO::FETCH_OBJ);
							$redenq=$query5->rowCount();
							?>
							<h4><?php echo htmlentities($redenq);?></h4>
						</div>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<!-- Bookings Row -->
		<div class="four-grids">
			<div class="col-md-3 four-grid">
				<a href="manage-bookings.php">
					<div class="four-agileinfo">
						<div class="icon">
							<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>All Bookings</h3>
							<?php 
							$sql1 = "SELECT BookingId from tblbooking";
							$query1 = $dbh -> prepare($sql1);
							$query1->execute();
							$results1=$query1->fetchAll(PDO::FETCH_OBJ);
							$cnt1=$query1->rowCount();
							?>
							<h4><?php echo htmlentities($cnt1);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-3 four-grid">
				<a href="manage-bookings.php">
					<div class="four-wthree">
						<div class="icon">
							<i class="glyphicon glyphicon-time" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>New Bookings</h3>
							<?php 
							$sql ="SELECT BookingId from tblbooking where (status is null || status='')";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$newbookings=$query->rowCount();
							?>
							<h4><?php echo htmlentities($newbookings);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-3 four-grid">
				<a href="manage-bookings.php">
					<div class="four-agileits">
						<div class="icon">
							<i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Cancelled Bookings</h3>
							<?php 
							$sql ="SELECT BookingId from tblbooking where (status='2')";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cancelbooking=$query->rowCount();
							?>
							<h4><?php echo htmlentities($cancelbooking);?></h4>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-3 four-grid">
				<a href="manage-bookings.php">
					<div class="four-w3ls">
						<div class="icon">
							<i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
						</div>
						<div class="four-text">
							<h3>Confirmed Bookings</h3>
							<?php 
							$sql ="SELECT BookingId from tblbooking where (status='1')";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$confirmedbooking=$query->rowCount();
							?>
							<h4><?php echo htmlentities($confirmedbooking);?></h4>
						</div>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

<?php include('includes/footer.php');?>
</div>
</div>

	<!--/sidebar-menu-->
	<?php include('includes/sidebarmenu.php');?>
	<div class="clearfix"></div>		
</div>
<script>
var toggle = true;
			
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
	$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
	$("#menu span").css({"position":"absolute"});
  }
  else
  {
	$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
	setTimeout(function() {
	  $("#menu span").css({"position":"relative"});
	}, 400);
  }
				
	toggle = !toggle;
});
</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
