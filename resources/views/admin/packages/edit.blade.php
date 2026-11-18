@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Update Package')
@section('breadcrumb', 'Update Tour Package')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Update Package</h3>
		<div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<form class="form-horizontal" name="package" method="POST" action="{{ route('admin.packages.update', $package->PackageId) }}">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="packagename" class="col-sm-2 control-label">Package Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagename" id="packagename" placeholder="Create Package" value="{{ old('packagename', $package->PackageName) }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagetype" class="col-sm-2 control-label">Package Type</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagetype" id="packagetype" placeholder="Package Type eg- Family Package / Couple Package" value="{{ old('packagetype', $package->PackageType) }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagelocation" class="col-sm-2 control-label">Package Location</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagelocation" id="packagelocation" placeholder="Package Location" value="{{ old('packagelocation', $package->PackageLocation) }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packageprice" class="col-sm-2 control-label">Package Price in INR (&#8377;)</label>
						<div class="col-sm-8">
							<input type="number" class="form-control1" name="packageprice" id="packageprice" placeholder="Package Price" value="{{ old('packageprice', $package->PackagePrice) }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagefeatures" class="col-sm-2 control-label">Package Features</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagefeatures" id="packagefeatures" placeholder="Package Features Eg- Free Pickup-Drop, Guide Included" value="{{ old('packagefeatures', $package->PackageFetures) }}" required>
						</div>
					</div>		

					<div class="form-group">
						<label for="packagedetails" class="col-sm-2 control-label">Package Details</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="5" cols="50" name="packagedetails" id="packagedetails" placeholder="Package Details" required>{{ old('packagedetails', $package->PackageDetails) }}</textarea> 
						</div>
					</div>															

					<div class="form-group">
						<label class="col-sm-2 control-label">Package Image</label>
						<div class="col-sm-8">
							<img src="{{ asset('admin/pacakgeimages/' . $package->PackageImage) }}" width="200" style="border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">&nbsp;&nbsp;&nbsp;
							<a href="{{ route('admin.packages.change-image', $package->PackageId) }}" class="btn btn-default"><i class="fa fa-picture-o"></i> Change Image</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Last Updation Date</label>
						<div class="col-sm-8" style="padding-top: 7px;">
							{{ $package->UpdationDate ?? 'Not updated yet' }}
						</div>
					</div>		

					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn-primary btn">Update</button>
							<a href="{{ route('admin.packages.index') }}" class="btn-default btn">Back to List</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
