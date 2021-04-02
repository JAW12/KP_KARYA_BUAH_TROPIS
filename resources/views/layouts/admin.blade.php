@extends('layouts.app')
@section('role')
    @include('layouts.admin-navbar')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.admin-sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 offset-md-3 offset-lg-2">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
@section('head')
<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
    font-size: 3.5rem;
    }
}
</style>

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
