@extends('layouts.master')
@section('title', 'PT. Karya Buah Tropis - Masuk Akun')
@section('style')
    <link rel="stylesheet" href="{{asset('css/signin.css')}}">
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .linear{
            background-image: linear-gradient(to right , #4286f4, #32adff);
        }

        .alert{
            margin-bottom: 15px !important;
        }
    </style>
@endsection
@section('content')
    <form class="form-signin" method="post" action="/login">
        @csrf
        <div class="text-center">
            <img class="mb-4" src="{{asset('storage/img/logo.png')}}" alt="" width="150" style="margin-top: -15%;">
        </div>
        <h1 class="h3 mb-0 font-weight-normal text-center">Masuk Akun</h1>
        <p class="mb-4 mt-0 font-weight-normal text-center">Tidak punya akun? <a href="{{route('register')}}">Mendaftar disini</a></p>
        @if(session()->has('status'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @include('layouts.alert')
        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text form-control" id="basic-addon1">@</span>
                </div>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text form-control" id="basic-addon1"><i class="fa fa-lock my-1"></i></span>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
        </div>

        <div class="form-group d-flex justify-content-between">
            <div>
                <input type="checkbox" value="remember"> Ingat saya
            </div>
            <div>
                <a href="/forgot">Lupa password Anda?</a>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-lg btn-primary w-100 linear mt-2" type="submit">Masuk</button>
        </div>
    </form>
@endsection
