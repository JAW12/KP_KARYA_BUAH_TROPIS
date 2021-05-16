@extends('layouts.master')
@section('title', 'PT. Karya Buah Tropis - Reset Password')
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
    </style>
@endsection
@section('content')
    <form class="form-signin" method="post">
        @csrf
        <div class="text-center">
            <img class="mb-4" src="{{asset('images/logo.png')}}" alt="" width="150" style="margin-top: -15%;">
        </div>
        <h1 class="h3 mb-0 font-weight-normal text-center">Reset Password</h1>
        <p class="mb-4 mt-0 font-weight-normal text-center text-muted">Mohon untuk mengisi password baru yang lebih aman dan mudah diingat.</p>
        @error('email')
            <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @enderror
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirm">Konfirmasi Password</label>
            <input type="password" id="confirm" name="confirm" class="form-control @error('confirm') is-invalid @enderror" placeholder="Konfirmasi Password">
            @error('confirm')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="text-center">
            <button class="btn btn-lg btn-primary w-100 linear mb-3 mt-2" type="submit">Meminta kode reset</button>
        </div>
    </form>
@endsection
