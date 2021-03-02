@extends('layouts.admin')
@section('title', 'Permintaan Buah')
@section('content')
<h1 class="text-center mt-5 mb-3">Permintaan Buah</h1>
<div class="text-right mb-3">
    <a href="{{route('admin.permintaan.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
</div>
<div class="table-responsive mb-5">
    <table id="stok_bahan_baku" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class=" text-center">#</th>
            <th class=" text-center">Kode</th>
            <th class="text-center">Tgl</th>
            <th class="text-center">Status Permintaan</th>
            <th class="text-center">Oleh</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
            @foreach($header as $data)
            <tr>
                <td class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</td>
                <th class="align-middle text-center" style="width: 10%">{{$data->kode}}</th>
                <td class="align-middle" style="width: 15%">{{$data->created_at}}</td>
                <td class="align-middle text-center @if($data->status() == false && $data->status != 0) text-secondary @elseif($data->status == 0) text-danger @else text-success @endif" style="width: 30%">@if($data->status() == false && $data->status != 0) Belum Selesai @elseif($data->status == 0) Dibatalkan @else Sudah Selesai  @endif</td>
                <td class="align-middle text-center" style="width: 25%">{{$data->user()->nama}}</td>
                <td class="align-middle text-center" style="width: 35%">
                    <a href="{{route('admin.permintaan.detail', $data->id)}}" class="btn btn-info col my-1">
                        <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                    </a>
                    <a href="{{route('admin.permintaan.hapus', $data->id)}}" class="btn btn-danger col my-1 @if($data->sudah() == true || $data->status == 0) disabled @endif">
                        <i class="fas fa-trash-alt"></i>
                        Hapus
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
        $('#stok_bahan_baku').DataTable();

        $('.detail').click(function(){
            var id = $(this).attr('id');
            $('.modal-title').html("Detail " + $(this).attr('nama'));

            $('#detailModal').modal('show');
        });
    });
</script>
@endsection
