@extends('layouts.admin')

@section('title', 'Wayfarer | Admin Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<!-- Overview Row -->
<div class="four-grids">
	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.users.index') }}">
			<div class="four-agileits">
				<div class="icon">
					<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Total Users</h3>
					<h4>{{ $stats['users'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.issues.index') }}">
			<div class="four-w3ls">
				<div class="icon">
					<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Issues Raised</h3>
					<h4>{{ $stats['issues'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.packages.index') }}">
			<div class="four-wthree">
				<div class="icon">
					<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Total Packages</h3>
					<h4>{{ $stats['packages'] }}</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="clearfix"></div>
</div>

<!-- Enquiries Row -->
<div class="four-grids">
	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.enquiries.index') }}">
			<div class="four-agileinfo">
				<div class="icon">
					<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Total Enquiries</h3>
					<h4>{{ $stats['enquiries'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.enquiries.index') }}">
			<div class="four-agileits">
				<div class="icon">
					<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>New Enquiries</h3>
					<h4>{{ $stats['new_enquiries'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4 four-grid">
		<a href="{{ route('admin.enquiries.index') }}">
			<div class="four-w3ls">
				<div class="icon">
					<i class="glyphicon glyphicon-check" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Read Enquiries</h3>
					<h4>{{ $stats['read_enquiries'] }}</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="clearfix"></div>
</div>

<!-- Bookings Row -->
<div class="four-grids">
	<div class="col-md-3 four-grid">
		<a href="{{ route('admin.bookings.index') }}">
			<div class="four-agileinfo">
				<div class="icon">
					<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>All Bookings</h3>
					<h4>{{ $stats['all_bookings'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-3 four-grid">
		<a href="{{ route('admin.bookings.index') }}">
			<div class="four-wthree">
				<div class="icon">
					<i class="glyphicon glyphicon-time" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>New Bookings</h3>
					<h4>{{ $stats['new_bookings'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-3 four-grid">
		<a href="{{ route('admin.bookings.index') }}">
			<div class="four-agileits">
				<div class="icon">
					<i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Cancelled Bookings</h3>
					<h4>{{ $stats['cancelled_bookings'] }}</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-3 four-grid">
		<a href="{{ route('admin.bookings.index') }}">
			<div class="four-w3ls">
				<div class="icon">
					<i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
				</div>
				<div class="four-text">
					<h3>Confirmed Bookings</h3>
					<h4>{{ $stats['confirmed_bookings'] }}</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="clearfix"></div>
</div>
@endsection
