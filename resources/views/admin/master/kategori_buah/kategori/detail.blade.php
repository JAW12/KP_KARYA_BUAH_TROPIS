@extends('layouts.admin')
@section('title', "Detail Kategori - $header->nama")
@section('content')
    <a href="{{route('admin.master.kategori_buah')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail {{$header->nama}}</h1>
    <form method="post" id="formDetail">
        @csrf
        <div class="mb-2">
            <input type="hidden" name="id" value="{{$header->id}}">
            <div class="form-group">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $header->nama ? $header->nama : ''}}">
                @error('nama')
                <div class="invalid-feedback">
                    Field nama harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea rows=15 class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">{{str_replace("<br />", "\n", $header->keterangan ? $header->keterangan : '')}}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">
                    Field keterangan harus diisi
                </div>
                @enderror
            </div>
        </div>
        <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
@endsection
