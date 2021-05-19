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
                        <a href="{{route('admin.stok.produk.detail', $data->slug)}}" class="btn btn-info col my-1">
                            <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                        </a>
                        @if (Auth::user()->role == "3")
                        <button type="submit" class="btn btn-warning" onclick="openSwal()" value="{{$data->id}}" id="idproduk"> Ubah Harga </button>
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
    function openSwal() {
        Swal.fire({
            title: 'Masukkan harga baru',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Kumpul',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true
        }).then((result) => {
            if (result.value) {
                sessionStorage.setItem('hargabaru', result.value);
                sessionStorage.setItem('idproduk', document.getElementById("idproduk"));
                window.location.href = `/admin/stok/produk/ubahHarga`;
            }
        });
    }
</script>
@endsection
