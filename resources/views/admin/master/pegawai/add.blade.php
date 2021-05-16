@extends('layouts.admin')
@section('title', "Tambah Pegawai")
@section('content')
    <a href="{{route('admin.master.pegawai')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Tambah Pegawai</h1>
    <form method="post" id="formAdd" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <div class="form-group">
                <label for="nama" class="form-label">Nama Pegawai</label>
                <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') ? old('nama') : ''}}">
                @error('nama')
                <div class="invalid-feedback">
                    Field nama harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Role Pegawai</label>
                <select name="role" id="role" class="mb-2 form-control">
                    <option value="1">Produksi</option>
                    <option value="2">Pembelian</option>
                    <option value="3">Penjualan</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    Field role harus diisi
                </div>
                @enderror
            </div>
        </div>
        <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
        <button type="reset" id="reset" class="btn btn-danger">Reset</button>
    </form>
@endsection
