@extends('layouts.app')

@section('title', 'Wayfarer – ' . ($title ?? ucfirst($page->type)))
@section('body_class', 'page-editorial')

@section('content')
<div class="inner-page-banner">
	<div class="banner-overlay"></div>
	<div class="container banner-inner-content">
		<span class="banner-crumb"><a href="{{ route('home') }}">Home</a> / {{ $title ?? ucfirst($page->type) }}</span>
		<h1 class="wow zoomIn animated" data-wow-delay=".2s">{{ $title ?? ucfirst($page->type) }}</h1>
		<p>{{ $subtitle ?? 'Official Wayfarer Information' }}</p>
	</div>
</div>

<div class="editorial-page-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="editorial-card wow fadeInUp animated" data-wow-delay=".2s">
					<div class="editorial-body">
						{!! $page->detail !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
