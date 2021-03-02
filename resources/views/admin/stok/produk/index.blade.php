@extends('layouts.admin')
@section('title', 'Stok Produk')
@section('content')
<h1 class="text-center mt-5 mb-3">Stok Produk</h1>
<div class="table-responsive mb-5">
    <table id="stok_produk" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class="text-center">#</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
                @foreach($header as $data)
                <tr>
                    <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                    <td class="align-middle text-center" style="width: 10%">{{$data->category->nama}}</td>
                    <td class="align-middle" style="width: 50%">{{$data->nama}}</td>
                    <td class="align-middle text-center" style="width: 10%">{{$data->jumlah()}}</td>
                    <td class="align-middle text-center" style="width: 20%">
                        <a href="{{route('admin.stok.produk.detail', $data->slug)}}" class="btn btn-info col my-1">
                            <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
    $(document).ready( function () {
            $('#stok_produk').DataTable();
        });
</script>
@endsection
