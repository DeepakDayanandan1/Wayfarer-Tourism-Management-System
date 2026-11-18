@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Manage Users')
@section('breadcrumb', 'Manage Users')

@section('content')
<div class="agile-grids">	
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h2>Manage Users</h2>
			<div class="table-responsive-admin">
			<table id="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Mobile No.</th>
						<th>Email Id</th>
						<th>RegDate</th>
						<th>Updation Date</th>
						<th class="table-actions-cell">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($users as $result)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td class="table-nowrap"><strong>{{ $result->FullName }}</strong></td>
						<td class="table-nowrap">{{ $result->MobileNumber }}</td>
						<td>{{ $result->EmailId }}</td>
						<td class="table-nowrap">{{ $result->RegDate }}</td>
						<td class="table-nowrap">{{ $result->UpdationDate ?? 'N/A' }}</td>
						<td class="table-actions-cell">
							<a href="{{ route('admin.users.bookings', $result->EmailId) }}" class="btn btn-primary btn-sm">User Bookings</a>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7" class="text-center" style="padding: 30px;">No registered users found.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			</div>

			@if($users->hasPages())
			<div class="text-center" style="margin-top: 20px;">
				{{ $users->links() }}
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
	if ($.fn.basictable) {
		$('#table').basictable({ breakpoint: 768 });
	}
});
</script>
@endsection
