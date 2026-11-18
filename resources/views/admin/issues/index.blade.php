@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Manage Issues')
@section('breadcrumb', 'Manage Issues')

@section('content')
<div class="agile-grids">	
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h2>Manage Issues</h2>
			<div class="table-responsive-admin">
			<table id="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Mobile No.</th>
						<th>Email Id</th>
						<th>Issues</th>
						<th style="min-width: 220px;">Description</th>
						<th>Posting date</th>
						<th class="table-actions-cell" style="min-width: 130px;">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($issues as $result)
					<tr>
						<td class="table-nowrap" width="90"><strong>#00{{ $result->id }}</strong></td>
						<td class="table-nowrap"><strong>{{ $result->user->FullName ?? 'N/A' }}</strong></td>
						<td class="table-nowrap">{{ $result->user->MobileNumber ?? 'N/A' }}</td>
						<td>{{ $result->UserEmail }}</td>
						<td><span class="label label-info">{{ $result->Issue }}</span></td>
						<td>
							@if($result->Description)
								<div class="table-cell-comment">{{ $result->Description }}</div>
							@else
								<span class="text-muted">None</span>
							@endif
						</td>
						<td class="table-nowrap">{{ $result->PostingDate }}</td>
						<td class="table-actions-cell">
							<a href="{{ route('admin.issues.show', $result->id) }}" class="btn btn-primary btn-block" style="margin-bottom: 5px;">View</a>
							<form action="{{ route('admin.issues.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this issue?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-block">Delete</button>
							</form>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="8" class="text-center" style="padding: 30px;">No support issues found.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			</div>

			@if($issues->hasPages())
			<div class="text-center" style="margin-top: 20px;">
				{{ $issues->links() }}
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
