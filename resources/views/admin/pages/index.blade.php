@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Manage Pages')
@section('breadcrumb', 'Update Page Data')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<h3>Update Page Data</h3>
		<div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<form class="form-horizontal" name="package" method="POST" action="{{ route('admin.pages.update') }}">
					@csrf
					<div class="form-group">
						<label class="col-sm-2 control-label">Select page</label>
						<div class="col-sm-8">
							<select name="type" class="form-control1" onchange="location = '{{ route('admin.pages.index') }}?type=' + this.value;">
								<option value="terms" {{ $selectedType == 'terms' ? 'selected' : '' }}>Terms &amp; Conditions</option>
								<option value="privacy" {{ $selectedType == 'privacy' ? 'selected' : '' }}>Privacy &amp; Policy</option>
								<option value="aboutus" {{ $selectedType == 'aboutus' ? 'selected' : '' }}>About Us</option> 
								<option value="contact" {{ $selectedType == 'contact' ? 'selected' : '' }}>Contact Us</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Selected Page</label>
						<div class="col-sm-8" style="padding-top: 7px;">
							<strong>{{ strtoupper($selectedType) }}</strong>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Page Details</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="10" cols="50" name="detail" id="pgedetails" placeholder="Page Content / HTML details" required>{{ old('detail', $page->detail ?? '') }}</textarea> 
						</div>
					</div>

					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit" value="Update" class="btn-primary btn">Update Page</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
