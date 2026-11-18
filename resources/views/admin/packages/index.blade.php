@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Manage Packages')
@section('breadcrumb', 'Manage Packages')

@section('content')
<div class="agile-grids">	
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h2>Manage Packages</h2>
			<div style="margin-bottom: 20px;">
				<a href="{{ route('admin.packages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Package</a>
			</div>
			<div class="table-responsive-admin">
			<table id="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Type</th>
						<th>Location</th>
						<th>Price</th>
						<th>Creation Date</th>
						<th class="table-actions-cell" style="min-width: 140px;">Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($packages as $result)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td><strong>{{ $result->PackageName }}</strong></td>
						<td><span class="label label-info">{{ $result->PackageType }}</span></td>
						<td><i class="fa fa-map-marker text-danger"></i> {{ $result->PackageLocation }}</td>
						<td class="table-nowrap">&#8377; {{ number_format($result->PackagePrice) }}</td>
						<td class="table-nowrap">{{ $result->Creationdate ? date('Y-m-d', strtotime($result->Creationdate)) : 'N/A' }}</td>
						<td class="table-actions-cell">
							<a href="{{ route('admin.packages.edit', $result->PackageId) }}" class="btn btn-primary btn-block" style="margin-bottom: 5px;">View Details</a>
							<form action="{{ route('admin.packages.destroy', $result->PackageId) }}" method="POST" onsubmit="return confirm('Do you really want to delete this package?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-block">Delete</button>
							</form>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7" class="text-center" style="padding: 30px;">No tour packages found.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			</div>

			@if($packages->hasPages())
			<div class="text-center" style="margin-top: 20px;">
				{{ $packages->links() }}
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
