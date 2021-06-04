@extends('layouts.admin')
@section('title', 'Master Pegawai')
@section('content')
<h1 class="text-center mt-5 mb-3">Master Banner</h1>
<form class="inline-form" enctype="multipart/form-data" method="post">
    @csrf
    <input type="file" name="foto" id="inputFoto">
    <button id="tambah" type="submit" class="btn btn-primary">Tambah</button>
</form>
<div class="container my-3">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($header as $h)
            <div class="col">
                <div class="card">
                    <img src="{{asset('storage/img/banner/'. $h->url)}}" class="card-img-top" alt="..." style="object-fit: cover; height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between">
                            {{$h->nama}}
                            <a href="{{route('admin.master.banner.hapus', $h->id)}}" class="btn btn-danger">
                                <i class="fas fa-trash mr-auto"></i> Hapus
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
