@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Manage Enquiries')
@section('breadcrumb', 'Manage Enquiries')

@section('content')
<div class="agile-grids">	
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h2>Manage Enquiries</h2>
			<div class="table-responsive-admin">
			<table id="table">
				<thead>
					<tr>
						<th>Ticket id</th>
						<th>Name</th>
						<th>Mobile No./ Email</th>
						<th>Subject</th>
						<th style="min-width: 220px;">Description</th>
						<th>Posting date</th>
						<th class="table-actions-cell">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($enquiries as $result)
					<tr>
						<td class="table-nowrap"><strong>#TCKT-{{ $result->id }}</strong></td>
						<td class="table-nowrap"><strong>{{ $result->FullName }}</strong></td>
						<td class="table-nowrap">{{ $result->MobileNumber }} /<br />{{ $result->EmailId }}</td>
						<td><strong>{{ $result->Subject }}</strong></td>
						<td>
							@if($result->Description)
								<div class="table-cell-comment">{{ $result->Description }}</div>
							@else
								<span class="text-muted">None</span>
							@endif
						</td>
						<td class="table-nowrap">{{ $result->PostingDate }}</td>
						<td class="table-actions-cell">
							@if($result->Status == 1)
								<span class="label label-success" style="margin-right: 5px;">Read</span>
							@else
								<form action="{{ route('admin.enquiries.read', $result->id) }}" method="POST" style="display:inline;">
									@csrf
									<button type="submit" class="btn btn-warning btn-xs" style="margin-right: 5px;">Mark Read</button>
								</form>
							@endif
							<form action="{{ route('admin.enquiries.destroy', $result->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Do you really want to delete this enquiry?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-xs" style="color:red; background:none; border:none; padding:0; text-decoration:underline; cursor:pointer;">Delete</button>
							</form>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7" class="text-center" style="padding: 30px;">No enquiries found.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			</div>

			@if($enquiries->hasPages())
			<div class="text-center" style="margin-top: 20px;">
				{{ $enquiries->links() }}
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
