@extends('layouts.admin')
@section('title', "Detail Pegawai - $header->nama")
@section('content')
    <a href="{{route('admin.master.pegawai')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail {{$header->nama}}</h1>
    <div class="row pb-5">
        <div class="col-12">
            <form method="post" id="formDetail">
                @csrf
                <div class="mb-2">
                    <input type="hidden" name="id" value="{{$header->id}}">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $header->nama ? $header->nama : ''}}">
                        @error('nama')
                        <div class="invalid-feedback">
                            Field nama harus diisi
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-label">Role Pegawai</label>
                        <select name="role" id="role" class="mb-2 form-control" @if($header->role == 4) disabled @endif>
                            <option value="1" @if($header->role == 1) selected @endif>Produksi</option>
                            <option value="2" @if($header->role == 2) selected @endif>Pembelian</option>
                            <option value="3" @if($header->role == 3) selected @endif>Penjualan</option>
                            @if($header->role == 4)
                            <option value="4" @if($header->role == 4) selected @endif>Owner</option>
                            @endif
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            Field role harus diisi
                        </div>
                        @enderror
                    </div>
                </div>
                <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
@endsection

