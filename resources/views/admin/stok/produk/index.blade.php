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
            <th class="text-center">Harga Jual</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
                @foreach($header as $data)
                <tr>
                    <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                    <td class="align-middle text-center" style="width: 10%">{{isset($data->category->nama) ? $data->category->nama : '-'}}</td>
                    <td class="align-middle" style="width: 35%">{{$data->nama}}</td>
                    <td class="align-middle text-center" style="width: 10%">{{$data->jumlah()}}</td>
                    <td class="align-middle" style="width: 15%">{{$data->harga_jual}}</td>
                    <td class="align-middle text-center" style="width: 20%">
                        @if (Auth::user()->role != "3")
                        <a href="{{route('admin.stok.produk.detail', $data->slug)}}" class="btn btn-info col my-1">
                            <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                        </a>
                        @endif
                        @if (Auth::user()->role == "3" || Auth::user()->role == "4")
                        <button type="submit" class="idproduk btn btn-warning" value="{{$data->id}}">Ubah Harga</button>
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
        $(document).on('click', '.idproduk', function(){
            $id = $(this).val();
            Swal.fire({
                title: 'Masukkan harga baru',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Kumpul',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = `/admin/stok/produk/ubahHarga/` + result.value + `/` + $id;
                }
            });
        });
    });
</script>
@endsection
