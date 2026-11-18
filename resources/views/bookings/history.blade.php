@extends('layouts.app')

@section('title', 'Wayfarer – My Tour History')
@section('body_class', 'page-history')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Dashboard / History</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">My Tour History</h1>
		<p>Track your past journeys, view current reservations, and manage booking confirmations.</p>
	</div>
</div>

<div class="dashboard-page-section">
	<div class="container">
		<div class="dashboard-card wow fadeInUp animated" data-wow-delay=".2s">
			<div class="dashboard-card-header">
				<div class="header-titles">
					<h2><i class="fa fa-suitcase"></i> All Reservations</h2>
					<p>Below is your complete booking itinerary record registered with {{ Auth::user()->EmailId }}.</p>
				</div>
				<a href="{{ route('packages.index') }}" class="btn-book-new"><i class="fa fa-plus"></i> Book Another Tour</a>
			</div>

			<div class="table-responsive custom-table-wrap">
				<table class="table custom-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Booking ID</th>
							<th>Tour Package</th>
							<th>Departure</th>
							<th>Return</th>
							<th>Special Notes</th>
							<th>Status</th>
							<th>Booked On</th>
							<th class="text-right">Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($bookings as $index => $booking)
						<tr>
							<td><span class="row-num">{{ $loop->iteration }}</span></td>
							<td><strong class="booking-ref">#BK-{{ $booking->BookingId }}</strong></td>
							<td>
								<a class="package-link" href="{{ route('packages.show', $booking->PackageId) }}">
									{{ $booking->package->PackageName ?? 'Custom Package #' . $booking->PackageId }}
								</a>
							</td>
							<td><span class="date-badge"><i class="fa fa-calendar-o"></i> {{ $booking->FromDate }}</span></td>
							<td><span class="date-badge"><i class="fa fa-calendar-check-o"></i> {{ $booking->ToDate }}</span></td>
							<td class="comment-cell">{{ $booking->Comment ?: 'None' }}</td>
							<td>
								@if($booking->status == 0)
									<span class="status-pill status-pending"><i class="fa fa-clock-o"></i> Pending</span>
								@elseif($booking->status == 1)
									<span class="status-pill status-confirmed"><i class="fa fa-check"></i> Confirmed</span>
								@elseif($booking->status == 2)
									@if($booking->CancelledBy == 'u')
										<span class="status-pill status-cancelled"><i class="fa fa-times"></i> Cancelled by You</span>
									@else
										<span class="status-pill status-cancelled"><i class="fa fa-times"></i> Cancelled by Admin</span>
									@endif
								@endif
							</td>
							<td class="text-muted text-sm">{{ date('M d, Y', strtotime($booking->RegDate)) }}</td>
							<td class="text-right">
								@if($booking->status == 2)
									<span class="action-disabled">Closed</span>
								@else
									<form action="{{ route('bookings.cancel', $booking->BookingId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you wish to cancel this reservation?');">
										@csrf
										<button type="submit" class="btn-cancel-booking" style="border:none;background:transparent;cursor:pointer;">
											<i class="fa fa-ban"></i> Cancel
										</button>
									</form>
								@endif
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="9" class="text-center empty-state-cell">
								<div class="empty-state">
									<i class="fa fa-calendar-times-o"></i>
									<h4>No reservations found</h4>
									<p>You haven't booked any tours yet. Find your dream getaway from our curated packages!</p>
									<a href="{{ route('packages.index') }}" class="btn-primary-action">Explore Packages</a>
								</div>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			@if($bookings->hasPages())
			<div class="pagination-wrapper text-center" style="margin-top: 30px;">
				{{ $bookings->links() }}
			</div>
			@endif
		</div>
	</div>
</div>
@endsection
