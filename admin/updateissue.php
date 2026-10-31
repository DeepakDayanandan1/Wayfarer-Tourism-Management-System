<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
	header('location:index.php');
	exit;
}
else{ 
	$iid=intval($_GET['iid']);
	if(isset($_POST['submit2']))
	{
		$remark=$_POST['remark'];
		$sql = "UPDATE tblissues SET AdminRemark=:remark WHERE id=:iid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':remark',$remark, PDO::PARAM_STR);
		$query->bindParam(':iid',$iid, PDO::PARAM_STR);
		$query->execute();
		$msg="Remark successfully updated.";
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Wayfarer | Update Issue Remark</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
body {
	background: #f5f6f2;
	padding: 24px;
	font-family: 'Roboto', sans-serif;
}
.issue-card {
	background: #fff;
	border: 1px solid #e5e9e3;
	border-radius: 12px;
	padding: 24px;
	box-shadow: 0 10px 30px rgba(0,0,0,0.06);
	max-width: 600px;
	margin: 0 auto;
}
.issue-card h3 {
	margin-top: 0;
	margin-bottom: 20px;
	font-size: 20px;
	font-weight: 700;
	color: #173a32;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.succWrap {
	padding: 10px 14px;
	margin-bottom: 20px;
	background: #d4edda;
	color: #155724;
	border-left: 4px solid #28a745;
	border-radius: 4px;
}
.btn-action-wrap {
	display: flex;
	gap: 10px;
	margin-top: 20px;
}
</style>
<script>
function f2() { window.close(); }
function f3() { window.print(); }
</script>
</head>
<body>

<div class="issue-card">
	<h3>
		<span><i class="fa fa-pencil-square-o" style="color:#ff5e3a;"></i> Update Issue Remark</span>
		<button type="button" class="btn btn-default btn-xs" onclick="f2()"><i class="fa fa-times"></i> Close</button>
	</h3>

	<?php if(isset($error) && $error){?><div class="errorWrap"><strong>ERROR:</strong> <?php echo htmlentities($error); ?></div><?php } 
	else if(isset($msg) && $msg){?><div class="succWrap"><strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?></div><?php }?>

	<?php 
	$sql = "SELECT * from tblissues where id=:iid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':iid',$iid, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{ 
			if($result->AdminRemark=="")
			{
	?>
		<form name="updateticket" id="updateticket" method="post"> 
			<div class="form-group">
				<label for="remark"><strong>Admin Remark:</strong></label>
				<textarea class="form-control" rows="5" name="remark" id="remark" placeholder="Enter resolution details or remarks here..." required></textarea>
			</div>
			<div class="btn-action-wrap">
				<input type="submit" name="submit2" value="Save Remark" class="btn btn-primary" style="min-width:130px;" />
				<button type="button" class="btn btn-default" onclick="f2()">Cancel</button>
			</div>
		</form>
	<?php 
			} else { 
	?>
		<div class="form-group">
			<label><strong>Current Admin Remark:</strong></label>
			<div class="well" style="background:#f8fafc; border-color:#e2e8f0; margin-bottom:12px;">
				<?php echo nl2br(htmlentities($result->AdminRemark)); ?>
			</div>
		</div>
		<div class="form-group">
			<label><strong>Remark Date:</strong></label>
			<p class="text-muted"><i class="fa fa-calendar"></i> <?php echo htmlentities($result->AdminremarkDate); ?></p>
		</div>
		<div class="btn-action-wrap">
			<button type="button" class="btn btn-default" onclick="f3()"><i class="fa fa-print"></i> Print</button>
			<button type="button" class="btn btn-primary" onclick="f2()">Done</button>
		</div>
	<?php 
			}
		}
	}
	?>
</div>

</body>
</html>
<?php } ?>
