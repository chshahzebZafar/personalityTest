<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Personality Test</title>
    <meta name="description" content="Personality Test">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('settings.site_detail.company_logo')) ?? asset('public/user/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/style.css') }}">
    @stack('css')
</head>


<body class="body__wrapper">
<!-- pre loader area start -->
<div id="back__preloader">
    <div id="back__circle_loader"></div>
    <div class="back__loader_logo">
        <img loading="lazy"  src="{{ asset('public/user/img/pre.png') }}" alt="Preload">
    </div>
</div>
@yield('main-content')
<!-- JS here -->
<script src="{{ asset('public/user/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('public/user/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/user/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/user/js/main.js') }}"></script>
@stack('js')
</body>
</html>
