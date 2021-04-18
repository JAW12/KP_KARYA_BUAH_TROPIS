@extends('layouts.admin')
@section('title', "Detail Buah - $header->nama")
@section('content')
    <a href="{{route('admin.master.kategori_buah')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail {{$header->nama}}</h1>
    <form method="post" id="formDetail">
        @csrf
        <div class="mb-2">
            <input type="hidden" name="id" value="{{$header->id}}">
            <div class="form-group">
                <label for="nama" class="form-label">Nama Buah</label>
                <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $header->nama ? $header->nama : ''}}">
                @error('nama')
                <div class="invalid-feedback">
                    Field nama harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="manfaat" class="form-label">Manfaat</label>
                <textarea style="" rows=15 class="form-control @error('manfaat') is-invalid @enderror" id="manfaat" name="manfaat">{{str_replace("<br />", "\n", $header->manfaat ? $header->manfaat : '')}}</textarea>
                @error('manfaat')
                <div class="invalid-feedback">
                    Field manfaat harus diisi
                </div>
                @enderror
            </div>
        </div>
        <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
@endsection
