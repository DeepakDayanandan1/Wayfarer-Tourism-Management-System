@extends('layouts.admin')

@section('title', 'Wayfarer | Manage User Bookings')
@section('breadcrumb', 'User Bookings')

@section('content')
<div class="agile-grids">	
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h2>Manage {{ $user->FullName ?? $email }}'s Bookings</h2>
			<div style="margin-bottom: 15px;">
				<a href="{{ route('admin.users.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Users</a>
			</div>
			<div class="table-responsive-admin">
			<table id="table">
				<thead>
					<tr>
						<th>Booking id</th>
						<th>Name</th>
						<th>Mobile No.</th>
						<th>Email Id</th>
						<th>Package</th>
						<th>From / To</th>
						<th style="min-width: 200px;">Comment</th>
						<th>Status</th>
						<th class="table-actions-cell">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($bookings as $result)
					<tr>
						<td class="table-nowrap"><strong>#BK-{{ $result->BookingId }}</strong></td>
						<td class="table-nowrap">{{ $result->user->FullName ?? ($user->FullName ?? 'N/A') }}</td>
						<td class="table-nowrap">{{ $result->user->MobileNumber ?? ($user->MobileNumber ?? 'N/A') }}</td>
						<td>{{ $result->UserEmail }}</td>
						<td>
							<a href="{{ route('admin.packages.edit', $result->PackageId) }}">
								{{ $result->package->PackageName ?? 'Package #' . $result->PackageId }}
							</a>
						</td>
						<td class="table-nowrap">{{ $result->FromDate }} To {{ $result->ToDate }}</td>
						<td>
							@if($result->Comment)
								<div class="table-cell-comment">{{ $result->Comment }}</div>
							@else
								<span class="text-muted">None</span>
							@endif
						</td>
						<td class="table-nowrap">
							@if($result->status == 0)
								<span class="label label-warning">Pending</span>
							@elseif($result->status == 1)
								<span class="label label-success">Confirmed</span>
							@elseif($result->status == 2)
								@if($result->CancelledBy == 'a')
									<span class="label label-danger">Canceled by you at {{ $result->UpdationDate }}</span>
								@else
									<span class="label label-danger">Canceled by User at {{ $result->UpdationDate }}</span>
								@endif
							@endif
						</td>
						<td class="table-actions-cell">
							@if($result->status == 2)
								<span class="text-muted">Cancelled</span>
							@elseif($result->status == 1)
								<form action="{{ route('admin.bookings.cancel', $result->BookingId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Do you really want to cancel this booking?');">
									@csrf
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
								</form>
							@else
								<form action="{{ route('admin.bookings.confirm', $result->BookingId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Do you want to confirm this booking?');">
									@csrf
									<button type="submit" class="btn btn-success btn-xs" style="margin-right: 5px;">Confirm</button>
								</form>
								<form action="{{ route('admin.bookings.cancel', $result->BookingId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Do you really want to cancel this booking?');">
									@csrf
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
								</form>
							@endif
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="9" class="text-center" style="padding: 30px;">No bookings found for this user.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			</div>
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
