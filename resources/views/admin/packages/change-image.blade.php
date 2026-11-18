@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Update Package Image')
@section('breadcrumb', 'Update Package Image')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Update Package Image</h3>
		<div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<form class="form-horizontal" name="package" method="POST" action="{{ route('admin.packages.update-image', $package->PackageId) }}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label class="col-sm-2 control-label">Current Image</label>
						<div class="col-sm-8">
							<img src="{{ asset('admin/pacakgeimages/' . $package->PackageImage) }}" width="200" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">New Image</label>
						<div class="col-sm-8">
							<input type="file" name="packageimage" id="packageimage" required>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn-primary btn">Update Image</button>
							<a href="{{ route('admin.packages.edit', $package->PackageId) }}" class="btn-default btn">Back to Package</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
