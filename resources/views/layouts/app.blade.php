<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@yield('title', 'Wayfarer – For people who love exploring')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset('images/logo.svg') }}?v={{ time() }}">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 3 & Font Awesome Stylesheets -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />

<!-- Scripts & Animations -->
<script src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
<script src="{{ asset('js/wow.min.js') }}"></script>
<script>
    new WOW().init();
</script>

@yield('styles')
</head>
<body class="@yield('body_class', 'page-home')">

    <!-- Floating Header -->
    @include('components.header')

    <!-- Flash Messages Container -->
    @if(session('success') || session('msg') || session('error') || $errors->any())
    <div class="container" style="margin-top: 90px; margin-bottom: 20px; position: relative; z-index: 100;">
        @if(session('success'))
            <div class="custom-alert success-alert">
                <i class="fa fa-check-circle"></i> <strong>Success:</strong> {{ session('success') }}
            </div>
        @endif
        @if(session('msg'))
            <div class="custom-alert success-alert">
                <i class="fa fa-check-circle"></i> <strong>Success:</strong> {{ session('msg') }}
            </div>
        @endif
        @if(session('error'))
            <div class="custom-alert error-alert">
                <i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="custom-alert error-alert">
                <i class="fa fa-exclamation-triangle"></i> <strong>Please resolve the following:</strong>
                <ul style="margin: 6px 0 0 18px; padding: 0;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @endif

    <!-- Main Page Content -->
    @yield('content')

    <!-- Footer Component -->
    @include('components.footer')

    <!-- Modal Dialogs -->
    @include('components.signup')
    @include('components.signin')
    @include('components.write-us')

    @yield('scripts')
</body>
</html>
