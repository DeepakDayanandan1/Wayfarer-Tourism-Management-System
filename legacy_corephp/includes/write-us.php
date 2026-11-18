<?php
error_reporting(0);
if(isset($_POST['submit_issue']))
{
$issue=$_POST['issue'];
$description=$_POST['description'];
$email=$_SESSION['login'];
$sql="INSERT INTO tblissues(UserEmail,Issue,Description) VALUES(:email,:issue,:description)";
$query = $dbh->prepare($sql);
$query->bindParam(':issue',$issue,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Your support ticket has been submitted. Our concierge team will review it shortly.";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
}
?>	

<div class="modal fade custom-auth-modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="writeUsModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="writeUsModalLabel"><i class="fa fa-life-ring"></i> How Can We Help You?</h4>
				<p class="modal-subtitle">Submit a request to our travel concierge team and we will assist promptly</p>
			</div>
			<div class="modal-body modal-spa">
				<div class="writ">
					<form name="help" method="post">
						<div class="form-group-custom">
							<label><i class="fa fa-tag"></i> Select Subject / Category</label>
							<select id="country" name="issue" class="form-control-custom" required>
								<option value="">-- Choose Category --</option> 		
								<option value="Booking Issues">Booking Issues &amp; Questions</option>
								<option value="Cancellation">Cancellation Request</option>
								<option value="Refund">Refund Status &amp; Policy</option>
								<option value="Itinerary Customization">Itinerary Customization</option>
								<option value="Other">Other Inquiry</option>														
							</select>
						</div>
						<div class="form-group-custom">
							<label><i class="fa fa-pencil"></i> Detailed Description</label>
							<textarea class="form-control-custom" rows="4" placeholder="Please describe how we can assist you..." name="description" required></textarea>
						</div>
						<div class="sub-bn" style="margin-top:20px;">
							<button type="submit" name="submit_issue" class="btn-auth-primary">Submit Ticket</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
