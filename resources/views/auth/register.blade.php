@extends('layouts.master')
@section('title', 'PT. Karya Buah Tropis - Daftar Akun')
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
    <form class="form-signup" method="post" action="{{route('register')}}">
        @csrf
        <div class="text-center">
            <img class="mb-4" src="{{asset('storage/img/logo.png')}}" alt="" width="150" style="margin-top: -15%;">
        </div>
        <h1 class="h3 mb-0 font-weight-normal text-center">Silahkan mendaftar</h1>
        <p class="mb-4 mt-0 font-weight-normal text-center">Sudah punya akun? <a href="{{route('login')}}">Masuk disini.</a></p>
        @include('layouts.alert')

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-control" id="basic-addon1">@</span>
                        </div>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{old('username')}}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-control" id="basic-addon1"><i class="my-1 fas fa-user"></i></span>
                        </div>
                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{old('nama')}}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Alamat email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text form-control" id="basic-addon1"><i class="fa fa-envelope my-1"></i></span>
                </div>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat email" value="{{old('email')}}">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-control" id="basic-addon1"><i class="fa fa-lock my-1"></i></span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" style="margin-bottom: 0px;" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="confirm">Konfirmasi Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text form-control" id="basic-addon1"><i class="fa fa-lock my-1"></i></span>
                        </div>
                        <input type="password" id="confirm" name="confirm" class="form-control @error('confirm') is-invalid @enderror" style="margin-bottom: 0px;" placeholder="Konfirmasi Password">
                        @error('confirm')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-lg btn-primary w-100 linear mt-2" type="submit">Mendaftar</button>
        </div>
    </form>
@endsection
