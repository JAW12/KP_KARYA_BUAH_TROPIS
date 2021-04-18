@extends('layouts.app')
@section('header')
    <!-- Scripts -->
    <script src="{{ asset('js/app2.js') }}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet">
@yield('head')
@endsection
@section('role')
    @include('layouts.user-navbar')
    <main class="body-content outer-top-vs">
        @yield('content')
    </main>
    @include('layouts.user-footer')
@endsection
