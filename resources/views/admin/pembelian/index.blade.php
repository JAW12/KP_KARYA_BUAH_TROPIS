@extends('layouts.admin')
@section('title', 'Pembelian Buah')
@section('content')
<h1 class="text-center mt-5 mb-3">Pembelian Buah</h1>
<div class="text-right mb-3">
    <a href="{{route('admin.pembelian.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
</div>
<div class="table-responsive mb-5">
    <table id="daftar-transaksi" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class=" text-center">#</th>
            <th class=" text-center">Kode</th>
            <th class="text-center">Pembeli</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Tempat</th>
            <th class="text-center">Total</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
            @foreach($header as $data)
            <tr>
                <td class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</td>
                <th class="align-middle text-center" style="width: 5%">{{$data->id}}</th>
                <td class="align-middle" style="width: 15%">{{$data->user()->nama}}</td>
                <td class="align-middle" style="width: 5%">{{$data->tanggal}}</td>
                <td class="align-middle" style="width: 5%">{{$data->tempat}}</td>
                <td class="align-middle" style="width: 5%">{{$data->total}}</td>
                <td class="align-middle text-center" style="width: 15%">
                    <a href="{{route('admin.pembelian.detail', $data->id)}}" class="btn btn-info col my-1">
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
        $('#daftar-transaksi').DataTable();

        $('.detail').click(function(){
            var id = $(this).attr('id');
            $('.modal-title').html("Detail " + $(this).attr('nama'));

            $('#detailModal').modal('show');
        });
    });
</script>
@endsection
