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
    <style>
        i.fa-shopping-cart{
            width: 2rem;
            text-align: center;
            vertical-align: middle;
            position: relative;
        }

        i.cart-circle:after {
            content: attr(data-count);
            position: absolute;
            background:red;
            height: 1rem;
            top: -0.5rem;
            right: 0.05rem;
            width: 1rem;
            text-align: center;
            line-height: 1rem;
            font-size: 0.75rem;
            text-align: center;
            padding-left: 0.1rem;
            border-radius: 50%;
            color: white;
            border: 1px solid red;
            font-family: sans-serif;
            font-weight: bold;
        }

    </style>
@yield('head')
@endsection
@section('role')
    @include('layouts.user-navbar')
    <main class="body-content outer-top-vs">
        @yield('content')
    </main>
    @include('layouts.user-footer')
@endsection
