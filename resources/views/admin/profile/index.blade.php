@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Profile')
@section('breadcrumb', 'Admin Profile')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Admin Profile</h3>
		<div class="panel-body">
			<form name="chngpwd" method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label class="col-md-2 control-label">User Name</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input class="form-control1" type="text" value="{{ $admin->UserName }}" readonly>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Name</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
							<input class="form-control1" type="text" name="name" id="name" value="{{ old('name', $admin->Name) }}" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Email</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
							<input class="form-control1" type="email" name="email" id="email" value="{{ old('email', $admin->EmailId) }}" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Mobile No</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input class="form-control1" type="tel" name="mobile" id="mobile" maxlength="10" value="{{ old('mobile', $admin->MobileNumber) }}" required>
						</div>
					</div>
				</div>
					
				<div class="col-sm-8 col-sm-offset-2">
					<button type="submit" name="submit" class="btn-primary btn">Submit</button>
					<a href="{{ route('admin.profile.password') }}" class="btn-default btn">Change Password</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
