@extends('layouts.user')
@section('title', 'PT. Karya Buah Tropis - Profil Akun Anda')
@section('content')
    <div class="container pt-3">
        @include('layouts.alert')
        <h3>Profil Akun Anda</h3>
        <form method="post" class="mt-3 pb-5">
            @csrf
            <h5 class="mt-3">Informasi Personal</h5>
            <div class="form-row">
                <div class="form-group col">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="john123" value="{{Auth::user()->username}}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col">
                    <label for="nama">Nama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="John Steve" value="{{Auth::user()->nama}}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="email">Alamat Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="johnsteve@gmail.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col">
                    <label for="email">No. Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square-alt"></i></span>
                        </div>
                        <input type="tel" name="telp" value="{{Auth::user()->telp}}" class="form-control" placeholder="0812345678910">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="" cols="30" rows="5" placeholder="Jl. Kenjeran No. 34">{{Auth::user()->alamat}}</textarea>
            </div>

            <h5 class="mt-3">Ubah Password Anda</h5>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" style="margin-bottom: 0px;" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="confirm">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" id="confirm" name="confirm" class="form-control @error('confirm') is-invalid @enderror" style="margin-bottom: 0px;" placeholder="Konfirmasi Password">
                    @error('confirm')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>
        </form>
    </div>
@endsection
