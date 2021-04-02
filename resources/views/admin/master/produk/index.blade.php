@extends('layouts.admin')
@section('title', 'Master Produk')
@section('content')
<h1 class="text-center mt-5 mb-3">Master Produk</h1>
<div class="text-right mb-3">
    <a href="{{route('admin.master.produk.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
</div>
<div class="table-responsive mb-5">
    <table id="stok_produk" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class="text-center">#</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Harga Jual</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
                @foreach($header as $data)
                <tr>
                    <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                    <td class="align-middle text-center" style="width: 10%">{{$data->category->nama}}</td>
                    <td class="align-middle" style="width: 50%">{{$data->nama}}</td>
                    <td class="align-middle" style="width: 10%">{{$data->harga_jual}}</td>
                    <td class="align-middle text-center" style="width: 20%">
                        <a href="{{route('admin.master.produk.detail', $data->slug)}}" class="btn btn-info col my-1">
                            <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                        </a>
                        @if($data->deleted_at == null)
                        <a href="{{route('admin.master.produk.hapus', $data->id)}}" class="btn btn-danger col my-1">
                            <i class="fas fa-trash mr-auto"></i> Hapus
                        </a>
                        @else
                        <a href="{{route('admin.master.produk.restore', $data->id)}}" class="btn btn-success col my-1">
                            <i class="fas fa-trash-restore mr-auto"></i> Kembalikan
                        </a>
                        @endif
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
