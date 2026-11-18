@extends('layouts.app')

@section('title', 'Wayfarer – Raised Support Tickets')
@section('body_class', 'page-tickets')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / Dashboard / Tickets</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">Raised Support Tickets</h1>
		<p>Track the status of your concierge inquiries, cancellation requests, and administrator remarks.</p>
	</div>
</div>

<div class="dashboard-page-section">
	<div class="container">
		<div class="dashboard-card wow fadeInUp animated" data-wow-delay=".2s">
			<div class="dashboard-card-header">
				<div class="header-titles">
					<h2><i class="fa fa-ticket"></i> Support History</h2>
					<p>Inquiries registered under <strong>{{ Auth::user()->EmailId }}</strong></p>
				</div>
				<a href="#" data-toggle="modal" data-target="#myModal3" class="btn-book-new"><i class="fa fa-plus"></i> Submit New Ticket</a>
			</div>

			<div class="table-responsive custom-table-wrap">
				<table class="table custom-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Ticket Ref</th>
							<th>Category</th>
							<th>Your Inquiry</th>
							<th>Concierge Remark</th>
							<th>Submitted Date</th>
							<th>Resolution Date</th>
						</tr>
					</thead>
					<tbody>
						@forelse($issues as $index => $result)
						<tr>
							<td><span class="row-num">{{ $loop->iteration }}</span></td>
							<td><strong class="booking-ref">#TKT-{{ $result->id }}</strong></td>
							<td><span class="category-badge"><i class="fa fa-tag"></i> {{ $result->Issue }}</span></td>
							<td class="comment-cell">{{ $result->Description }}</td>
							<td>
								@if($result->AdminRemark)
									<div class="admin-remark-box">
										<i class="fa fa-comment"></i> {{ $result->AdminRemark }}
									</div>
								@else
									<span class="status-pill status-pending"><i class="fa fa-clock-o"></i> Under Review</span>
								@endif
							</td>
							<td class="text-muted text-sm">{{ date('M d, Y', strtotime($result->PostingDate)) }}</td>
							<td class="text-muted text-sm">{{ $result->AdminremarkDate ? date('M d, Y', strtotime($result->AdminremarkDate)) : 'Pending' }}</td>
						</tr>
						@empty
						<tr>
							<td colspan="7" class="text-center empty-state-cell">
								<div class="empty-state">
									<i class="fa fa-ticket"></i>
									<h4>No support tickets found</h4>
									<p>Have an inquiry about an upcoming tour or need custom arrangements? Contact our team!</p>
									<a href="#" data-toggle="modal" data-target="#myModal3" class="btn-primary-action">Submit Ticket</a>
								</div>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			@if($issues->hasPages())
			<div class="pagination-wrapper text-center" style="margin-top: 30px;">
				{{ $issues->links() }}
			</div>
			@endif
		</div>
	</div>
</div>
@endsection
