@extends('layouts.user')
@section('title', 'PT. Karya Buah Tropis - Detail Transaksi')
@section('content')
    <div class="container pt-3">
        @include('layouts.alert')
        <div class="row">
            <div class="col"> <h1 class='text-center mb-3'>Detail Transaksi #{{$header->id}}</h1></div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <img id="foto" width="70%" src="{{asset('storage/img/transaksi/'.$header->bukti)}}" alt=""><br>
                <b>Tanggal Transaksi</b> : {{$header->created_at}} <br>
                <b>Status</b> : @if($header->status == -1) Dibatalkan @elseif($header->status == 0) Belum dibayar @elseif($header->status == 1) Lunas @elseif($header->status == 2) Sedang diproses @elseif($header->status == 3) Selesai @endif <br>
                @if($header->status == 0)
                    <b>Kontak CS untuk proses lebih lanjut <a href="https://wa.me/6285105009300/?text=Saya sudah order kak dengan kode order {{$header->id}} a/n {{$header->user()->nama}}" class="text-success">disini</a></b>
                @endif
                <br>
            </div>
            <div class="col-sm-12 col-lg-8">
                <b>Detail Pesanan : </b>
                <div class="table-responsive mb-5">
                    <table id="detail_transaksi" class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Buah</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-center">Subtotal</th>
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
            </div>
        </div>
    </div>
@endsection
