<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@yield('title', 'Wayfarer | Admin Portal')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset('images/logo.svg') }}?v={{ time() }}">

<!-- Bootstrap Core CSS -->
<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Custom CSS -->
<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('admin/css/morris.css') }}" type="text/css"/>
<!-- Graph CSS -->
<link href="{{ asset('admin/css/font-awesome.css') }}" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- jQuery -->
<script src="{{ asset('admin/js/jquery-2.1.4.min.js') }}"></script>

<!-- Tables CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/table-style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/basictable.css') }}" />
<script type="text/javascript" src="{{ asset('admin/js/jquery.basictable.min.js') }}"></script>

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400" rel="stylesheet" type="text/css"/>
<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<!-- Lined-Icons -->
<link rel="stylesheet" href="{{ asset('admin/css/icon-font.min.css') }}" type="text/css" />

@yield('styles')
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
<!--header start here-->
@include('components.admin-header')
<!--header end here-->

		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a> <i class="fa fa-angle-right"></i> <span>@yield('breadcrumb', 'Dashboard')</span></li>
        </ol>

        <!-- Flash alerts -->
        <div style="padding: 0 15px;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert" style="border-radius: 6px; margin-top: 15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert" style="border-radius: 6px; margin-top: 15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Notice:</strong> {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert" style="border-radius: 6px; margin-top: 15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Please check errors:</strong>
                    <ul style="margin: 5px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        @yield('content')

<!--footer start here-->
@include('components.admin-footer')
<!--footer end here-->
    </div>
</div>

	<!--/sidebar-menu-->
	@include('components.sidebar')
	<div class="clearfix"></div>		
</div>

<script>
var toggle = true;
			
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
	$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
	$("#menu span").css({"position":"absolute"});
  }
  else
  {
	$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
	setTimeout(function() {
	  $("#menu span").css({"position":"relative"});
	}, 400);
  }
				
	toggle = !toggle;
});
</script>
<!--js -->
<script src="{{ asset('admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('admin/js/scripts.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
@yield('scripts')
</body>
</html>
