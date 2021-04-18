@extends('layouts.admin')
@section('title', "Detail Transaksi $header->id")
@section('content')
    <a href="{{route('admin.transaksi')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail Transaksi #{{$header->id}}</h1>
    <div class="text-left mb-3">
        <b>Tanggal Transaksi</b> : {{$header->created_at}}
    </div>
    <div class="table-responsive mb-5">
        <table id="detail_transaksi" class="table table-striped table-bordered">
            <thead class="table-dark">
                <th class="text-center">#</th>
                <th class="text-center">Nama Buah</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga Jual</th>
                <th class="text-center">Subtotal</th>
                {{-- <th class="text-center">Aksi</th> --}}
            </thead>
            <tbody>
                @isset($detail)
                @foreach($detail as $data)
                <tr>
                    <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                    <td class="text-center align-middle" style="width: 50%">{{$data->product()->nama}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->jumlah}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->harga_jual}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->subtotal}}</td>
                    {{-- <td class='text-center align-middle' style="width: 10%">
                    </td> --}}
                </tr>
                @endforeach
                @endisset
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right">Total:</th>
                    <th style="text-align:center">{{$header->total}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var table = $('#detail_transaksi').DataTable();
    });
</script>
@endsection

