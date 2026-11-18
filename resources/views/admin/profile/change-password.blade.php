@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Change Password')
@section('breadcrumb', 'Change Password')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Change Admin Password</h3>
		<div class="panel-body">
			<form name="chngpwd" method="POST" action="{{ route('admin.profile.password.update') }}" class="form-horizontal" onsubmit="return validAdminPwd();">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label class="col-md-2 control-label">Current Password</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="password" name="password" class="form-control1" id="current_password" placeholder="Current Password" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">New Password</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-shield"></i></span>
							<input type="password" class="form-control1" name="newpassword" id="newpassword" placeholder="New Password" required minlength="4">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Confirm Password</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-check"></i></span>
							<input type="password" class="form-control1" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required minlength="4">
						</div>
					</div>
				</div>

				<div class="col-sm-8 col-sm-offset-2">
					<button type="submit" name="submit" class="btn-primary btn">Submit</button>
					<button type="reset" class="btn-inverse btn">Reset</button>
					<a href="{{ route('admin.profile.index') }}" class="btn-default btn">Back to Profile</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
function validAdminPwd() {
	if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
		alert("New Password and Confirm Password Field do not match !!");
		document.chngpwd.confirmpassword.focus();
		return false;
	}
	return true;
}
</script>
@endsection
