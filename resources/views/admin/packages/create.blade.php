@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Package Creation')
@section('breadcrumb', 'Create Package')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Create Package</h3>
		<div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<form class="form-horizontal" name="package" method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="packagename" class="col-sm-2 control-label">Package Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagename" id="packagename" placeholder="Create Package" value="{{ old('packagename') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagetype" class="col-sm-2 control-label">Package Type</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagetype" id="packagetype" placeholder="Package Type eg- Family Package / Couple Package" value="{{ old('packagetype') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagelocation" class="col-sm-2 control-label">Package Location</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagelocation" id="packagelocation" placeholder="Package Location" value="{{ old('packagelocation') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packageprice" class="col-sm-2 control-label">Package Price in INR (&#8377;)</label>
						<div class="col-sm-8">
							<input type="number" class="form-control1" name="packageprice" id="packageprice" placeholder="Package Price" value="{{ old('packageprice') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label for="packagefeatures" class="col-sm-2 control-label">Package Features</label>
						<div class="col-sm-8">
							<input type="text" class="form-control1" name="packagefeatures" id="packagefeatures" placeholder="Package Features Eg- Free Pickup-Drop, Guide Included" value="{{ old('packagefeatures') }}" required>
						</div>
					</div>		

					<div class="form-group">
						<label for="packagedetails" class="col-sm-2 control-label">Package Details</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="5" cols="50" name="packagedetails" id="packagedetails" placeholder="Package Details" required>{{ old('packagedetails') }}</textarea> 
						</div>
					</div>															

					<div class="form-group">
						<label for="packageimage" class="col-sm-2 control-label">Package Image</label>
						<div class="col-sm-8">
							<input type="file" name="packageimage" id="packageimage" required>
						</div>
					</div>	

					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" class="btn-primary btn">Create</button>
							<a href="{{ route('admin.packages.index') }}" class="btn-default btn">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
