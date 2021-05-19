@extends('layouts.admin')
@section('title', 'Transaksi Pelanggan')
@section('content')
<h1 class="text-center mt-5 mb-3">Transaksi Pelanggan</h1>
<div class="text-right mb-3">
    <a href="{{route('admin.transaksi.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
</div>
<div class="table-responsive mb-5">
    <table id="daftar-transaksi" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class=" text-center">#</th>
            <th class=" text-center">Kode</th>
            <th class="text-center">Tgl</th>
            <th class="text-center">Customer</th>
            <th class="text-center">Total</th>
            <th class="text-center">Status Transaksi</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
            @foreach($header as $data)
            <tr>
                <td class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</td>
                <th class="align-middle text-center" style="width: 5%">{{$data->id}}</th>
                <td class="align-middle" style="width: 15%">{{$data->created_at}}</td>
                <td class="align-middle" style="width: 15%">{{$data->user()->nama}}</td>
                <td class="align-middle" style="width: 5%">{{$data->total}}</td>
                {{-- -1 -> batalkan, 0 -> belum dibayar, 1 -> sudah lunas, 2 -> sedang diproses, 3 -> selesai --}}
                <td class="align-middle text-center @if($data->status == -1) text-danger @elseif($data->status == 0) text-primary @elseif($data->status == 1) text-dark @elseif($data->status == 2) text-warning @elseif($data->status == 3) text-success @endif" style="width: 10%">@if($data->status == -1) Dibatalkan @elseif($data->status == 0) Belum dibayar @elseif($data->status == 1) Lunas @elseif($data->status == 2) Sedang diproses @elseif($data->status == 3) Selesai  @endif</td>
                <td class="align-middle" style="width: 15%">{{isset($data->keterangan) ? $data->keterangan : '-'}}</td>
                <td class="align-middle text-center" style="width: 15%">
                    <a href="{{route('admin.transaksi.detail', $data->id)}}" class="btn btn-info col my-1">
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
