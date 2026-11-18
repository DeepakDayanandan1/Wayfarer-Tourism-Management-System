@extends('layouts.admin')

@section('title', 'Wayfarer | Update Issue Remark')
@section('breadcrumb', 'Update Issue Remark')

@section('content')
<div class="grid-form">
	<div class="grid-form1">
		<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
			<h3 style="margin: 0;"><i class="fa fa-pencil-square-o" style="color:#ff5e3a;"></i> Support Ticket #00{{ $issue->id }}</h3>
			<a href="{{ route('admin.issues.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Issues</a>
		</div>

		<div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<div class="table-responsive" style="margin-bottom: 30px;">
					<table class="table table-bordered">
						<tr>
							<th width="20%">Traveler Name</th>
							<td><strong>{{ $issue->user->FullName ?? 'N/A' }}</strong></td>
						</tr>
						<tr>
							<th>Traveler Email</th>
							<td>{{ $issue->UserEmail }}</td>
						</tr>
						<tr>
							<th>Mobile Number</th>
							<td>{{ $issue->user->MobileNumber ?? 'N/A' }}</td>
						</tr>
						<tr>
							<th>Issue Category</th>
							<td><span class="label label-info">{{ $issue->Issue }}</span></td>
						</tr>
						<tr>
							<th>Description</th>
							<td>{{ $issue->Description }}</td>
						</tr>
						<tr>
							<th>Submitted Date</th>
							<td>{{ $issue->PostingDate }}</td>
						</tr>
						@if($issue->AdminRemark)
						<tr>
							<th>Current Admin Remark</th>
							<td>
								<div class="alert alert-info" style="margin: 0;">
									{{ $issue->AdminRemark }}
									<br><small class="text-muted">Updated: {{ $issue->AdminremarkDate }}</small>
								</div>
							</td>
						</tr>
						@endif
					</table>
				</div>

				<form class="form-horizontal" method="POST" action="{{ route('admin.issues.remark', $issue->id) }}">
					@csrf
					<div class="form-group">
						<label class="col-sm-2 control-label">Admin Remark</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="5" name="remark" placeholder="Enter resolution details or concierge remark for traveler..." required>{{ old('remark', $issue->AdminRemark) }}</textarea>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<button type="submit" name="submit2" class="btn-primary btn">Update Remark</button>
							<a href="{{ route('admin.issues.index') }}" class="btn-default btn">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
