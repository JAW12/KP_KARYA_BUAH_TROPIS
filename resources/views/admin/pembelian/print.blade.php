@extends('layouts.master')
@section('title', 'Laporan Pembelian Buah')
@section('content')
<div class="container-fluid">
    <div class="container my-2">
        <div class="my-2 d-flex justify-content-around nowrap">
            <img src="{{asset('storage/img/logo.png')}}" class="img-fluid" style="width: 20%" alt="">
        </div>
        <div class="my-2 w-100 text-dark text-center font-weight-bold">
            <p class="text-dark">Jl. Lebak Indah Asri 2 No. 34, Surabaya, Jawa Timur, Indonesia </p>
            <p class="text-dark">
                <i class="fab fa-whatsapp"></i> 0851-0500-9300
                &nbsp; &nbsp; &nbsp;
                <i class="fas fa-phone"></i> +62 851-0500-9300
                &nbsp; &nbsp; &nbsp;
                <i class="far fa-envelope"></i> karyabuahtropis@gmail.com
                <br>
                <i class="fas fa-at"></i> www.karyabuahtropis.com
            </p>
        </div>
        <div class="w-100 text-center text-light bg-dark h5 py-3">
            Pembelian dari tanggal {{date('d-m-Y', strtotime(app('request')->input('from')))}} sampai {{date('d-m-Y', strtotime(app('request')->input('to')))}}
        </div>
        <hr class="border border-dark">
    </div>
    <div class="container my-4">
        @php $total = 0 @endphp
        @foreach($header as $h)
        <b>Pembelian #{{$loop->iteration}}</b><br>
        <b>Nama Admin</b> : {{$h['nama']}} &nbsp;&nbsp;&nbsp;&nbsp;
        <b>Tanggal Pembelian</b> : {{date('d-m-Y', strtotime($h['tanggal']))}} &nbsp;&nbsp;&nbsp;&nbsp;
        <b>Tempat Pembelian</b> : {{$h['tempat']}} <br>
        <hr>
        <div class="table-responsive mb-3">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Buah</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Harga Beli</th>
                    <th class="text-center">Subtotal</th>
                </thead>
                <tbody>
                    @foreach($h['detail'] as $d)
                        <tr>
                        <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                        <td class="text-center align-middle" style="width: 50%">{{$d['nama']}}</td>
                        <td class="text-center align-middle" style="width: 15%">{{$d['jumlah']}}</td>
                        <td class="text-center align-middle" style="width: 15%">{{number_format($d['harga_beli'], 2, ",", ".")}}</td>
                        <td class="text-center align-middle" style="width: 15%">{{number_format($d['subtotal'], 2, ",", ".")}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                <th colspan="4" style="text-align:center">Total:</th>
                @php $total += $h['total'] @endphp
                <th style="text-align:center">{{number_format($h['total'], 2, ",", ".")}}</th>
                </tfoot>
            </table>
        </div>
        @endforeach
        <hr>
        <div class="row my-3">
            <div class="col-xs-12 col-md-6">
                <h5>Total Pembelian Buah</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Buah</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach($summary as $s)
                                <tr>
                                <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                                <td class="text-center align-middle" style="width: 50%">{{$s->nama}}</td>
                                <td class="text-center align-middle" style="width: 50%">{{$s->jumlah}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 h5 align-text-bottom" style="text-align: right">
                Total Pembelian: Rp. {{number_format($total, 2, ",", ".")}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    window.print();
</script>
@endsection