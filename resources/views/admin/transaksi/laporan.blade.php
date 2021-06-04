@extends('layouts.admin')
@section('title', 'Laporan Penjualan PT. Karya Buah Tropis')
@section('content')
<h1 class="text-center mt-5 mb-3">Laporan Penjualan</h1>
<div class="mb-3">
    @if(Auth::user()->role == 4)
    <form method="get" target="_blank" action="{{route('admin.transaksi.laporan.print')}}" id="search" class="row row-cols-lg-auto g-3 align-items-center">
        @csrf
        <div class="col-12">
            <input type="date" name="from" id="from" class="form-control" value="{{date('Y-m-d')}}">
        </div>
        <div class="col-12">
            -
        </div>
        <div class="col-12">
            <input type="date" name="to" id="to" class="form-control" value="{{date('Y-m-d')}}">
        </div>
        <div class="col-12">
            <button type="button" id="cari" class="btn btn-success"><i class="fas fa-search"></i></i> Cari</a>
        </div>
        <div class="col-12">
            <button type="submit" id="cetak" class="btn btn-secondary"><i class="fas fa-print"></i></i> Cetak</a>
        </div>
    </form>
    @endif
</div>
<div id="isi"></div>
@endsection
@section('script')
    <script>
        $(function(){
            $("#cari").on('click', function(e){
                $("#isi").html("");
                let from = $("#from").val();
                let to = $("#to").val();
                $.ajax({
                    type:'POST',
                    url: 'laporan/get',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        from,
                        to
                    },
                    success:function(response) {
                        if(response.status == "success"){
                            let data = response.data;
                            let summary = response.summary;
                            if(data.length > 0){
                                let ctr = 1;
                                let total = 0;
                                console.log(data);
                                data.forEach(function(item, index){
                                    let date = formatDate(item.created_at);
                                    let isi = `
                                    <b>Penjualan #${ctr++}</b><br>
                                    <b>Nama Pembeli</b> : ${item.nama} &nbsp;&nbsp;&nbsp;&nbsp;`;
                                    if(item.metode_pembayaran == null){
                                        isi += `<b>Metode Pembayaran</b> : - &nbsp;&nbsp;&nbsp;&nbsp;`;
                                    }
                                    else{
                                        isi += `<b>Metode Pembayaran</b> : ${item.metode_pembayaran} &nbsp;&nbsp;&nbsp;&nbsp`;
                                    }
                                    isi += `<b>Tanggal Penjualan</b> : ${date} &nbsp;&nbsp;&nbsp;&nbsp;`;
                                    isi +=
                                    `<div class="table-responsive mb-5">
                                    <table class="table table-striped table-bordered">
                                    <thead class="table-dark"">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Harga Jual</th>
                                        <th class="text-center">Subtotal</th>
                                        </thead>
                                        <tbody>`;
                                    let ctrD = 1;
                                    item.detail.forEach(function(it, idx){
                                        isi += `<tr>
                                                <td class="text-center align-middle" style="width: 5%">${ctrD++}</td>
                                                <td class="text-center align-middle" style="width: 50%">${it.nama}</td>
                                                <td class="text-center align-middle" style="width: 15%">${it.jumlah}</td>
                                                <td class="text-center align-middle" style="width: 15%">${addCommas(it.harga_jual)}</td>
                                                <td class="text-center align-middle" style="width: 15%">${addCommas(it.subtotal)}</td>
                                                </tr>
                                            `;
                                    });
                                    isi += `
                                        </tbody>
                                        <tfoot class="table-dark">
                                        <th colspan="4" style="text-align:center">Total:</th>
                                        <th style="text-align:center">${addCommas(item.total)}</th>
                                        </tfoot>
                                    </table>
                                    </div>`
                                    $("#isi").append(isi);
                                    total += item.total;
                                });
                                let isi = `
                                <div class="row my-3">
                                    <div class="col-xs-12 col-md-6">
                                        <h5>Total Penjualan Produk</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead class="table-dark">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Nama Produk</th>
                                                    <th class="text-center">Jumlah</th>
                                                </thead>
                                                <tbody>`;
                                let ctrSummary = 1;
                                summary.forEach(function(item, index){
                                    isi += `<tr>
                                <td class="text-center align-middle" style="width: 5%">${ctrSummary++}</td>
                                <td class="text-center align-middle" style="width: 50%">${item.nama}</td>
                                <td class="text-center align-middle" style="width: 50%">${item.jumlah}</td>
                                </tr>`;
                                });
                                isi += `</tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 h5 align-text-bottom" style="text-align: right">
                                    Total Penjualan: Rp. ${addCommas(total)}
                                </div>
                            </div>`;
                                $("#isi").append(isi);
                            }
                            else{
                                $("#isi").html(`<div class="text-center">Data tidak ditemukan</div>`);
                            }
                        }
                    }
                });
            });

            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + '.' + '$2');
                }
                return x1 + x2;
            }

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [day, month, year].join('-');
            }
        });
    </script>
@endsection
