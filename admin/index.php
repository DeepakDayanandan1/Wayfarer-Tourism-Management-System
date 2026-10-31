<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
	$uname = trim($_POST['username']);
	$password = $_POST['password'];
	$md5password = md5($password);

	// Check matching either MD5 or plain-text password for admin
	$sql = "SELECT id, UserName, Password FROM admin WHERE (UserName=:uname OR EmailId=:uname) AND (Password=:md5password OR Password=:password)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uname', $uname, PDO::PARAM_STR);
	$query->bindParam(':md5password', $md5password, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0)
	{
		$_SESSION['alogin'] = $results[0]->UserName;
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
		exit;
	} else {
		$error = "Invalid administrator username or password.";
		echo "<script>alert('Invalid Details');</script>";
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Wayfarer | Admin Portal Sign In</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<style>
body {
	font-family: 'Plus Jakarta Sans', sans-serif;
	background: #090e17 url('../images/3333333.jpg') no-repeat center center / cover fixed !important;
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	margin: 0;
	padding: 20px;
}
.admin-login-overlay {
	position: fixed;
	inset: 0;
	background: rgba(9, 14, 23, 0.78);
	backdrop-filter: blur(8px);
	z-index: 1;
}
.admin-card-wrap {
	position: relative;
	z-index: 2;
	width: 100%;
	max-width: 440px;
}
.admin-card {
	background: rgba(255, 255, 255, 0.98);
	border-radius: 20px;
	padding: 40px;
	box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
	border: 1px solid rgba(255, 255, 255, 0.3);
}
.admin-card-brand {
	text-align: center;
	margin-bottom: 28px;
}
.admin-card-brand i {
	font-size: 38px;
	color: #ff5e3a;
	margin-bottom: 10px;
	display: inline-block;
}
.admin-card-brand h2 {
	margin: 0;
	font-size: 26px;
	font-weight: 700;
	color: #0f172a;
	letter-spacing: -0.02em;
}
.admin-card-brand p {
	font-size: 13px;
	color: #64748b;
	margin: 4px 0 0 0;
}
.admin-field-group {
	margin-bottom: 20px;
}
.admin-field-group label {
	display: block;
	font-size: 13px;
	font-weight: 600;
	color: #334155;
	margin-bottom: 6px;
}
.admin-field-group input {
	width: 100%;
	padding: 12px 16px;
	border: 1px solid #cbd5e1;
	border-radius: 10px;
	font-size: 14px;
	color: #0f172a;
	outline: none;
	transition: all 0.2s ease;
	background: #ffffff;
}
.admin-field-group input:focus {
	border-color: #ff5e3a;
	box-shadow: 0 0 0 3px rgba(255, 94, 58, 0.2);
}
.btn-admin-submit {
	width: 100%;
	background: #ff5e3a;
	color: #ffffff;
	border: none;
	border-radius: 10px;
	padding: 13px;
	font-size: 15px;
	font-weight: 700;
	cursor: pointer;
	transition: all 0.25s ease;
	box-shadow: 0 6px 16px rgba(255, 94, 58, 0.3);
}
.btn-admin-submit:hover {
	background: #e04b28;
	transform: translateY(-1px);
	box-shadow: 0 8px 20px rgba(255, 94, 58, 0.4);
}
.admin-footer-links {
	text-align: center;
	margin-top: 24px;
	padding-top: 18px;
	border-top: 1px solid #e2e8f0;
	font-size: 13px;
}
.admin-footer-links a {
	color: #64748b;
	text-decoration: none;
	transition: color 0.2s ease;
}
.admin-footer-links a:hover {
	color: #ff5e3a;
}
.credentials-hint {
	background: #f8fafc;
	border: 1px dashed #cbd5e1;
	border-radius: 8px;
	padding: 10px 14px;
	font-size: 12px;
	color: #475569;
	margin-bottom: 20px;
	text-align: center;
}
</style>
</head> 
<body>
	<div class="admin-login-overlay"></div>
	<div class="admin-card-wrap">
		<div class="admin-card">
			<div class="admin-card-brand">
				<i class="fa fa-compass"></i>
				<h2>Wayfarer Admin</h2>
				<p>Travel Management &amp; Reservations Control</p>
			</div>

			<div class="credentials-hint">
				Default credentials: <strong>admin</strong> / <strong>pass@123</strong>
			</div>

			<form method="post">
				<div class="admin-field-group">
					<label for="username"><i class="fa fa-user-o"></i> Administrator Username</label>
					<input type="text" name="username" id="username" placeholder="admin" required autofocus>
				</div>
				
				<div class="admin-field-group">
					<label for="password"><i class="fa fa-lock"></i> Password</label>
					<input type="password" name="password" id="password" placeholder="Enter password" required>
				</div>
				
				<button type="submit" name="login" class="btn-admin-submit">
					<i class="fa fa-sign-in"></i> Sign In to Dashboard
				</button>
			</form>

			<div class="admin-footer-links">
				<a href="../index.php"><i class="fa fa-arrow-left"></i> Return to Main Website</a>
			</div>
		</div>
	</div>
</body>
</html>
