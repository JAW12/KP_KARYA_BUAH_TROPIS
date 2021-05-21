@extends('layouts.admin')
@section('title', "Detail Pembelian $header->id")
@section('content')
    <a href="{{route('admin.pembelian')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail Pembelian #{{$header->id}}</h1>
    <div class="text-left mb-3">
        <b>Tanggal Transaksi</b> : {{$header->tanggal}} <br>
        @foreach ($customer as $item)
            @if($header->user_id == $item->id)
                <b>Nama Pembeli</b> : {{$item->nama}} <br>
            @endif
        @endforeach
    </div>
    <b>Detail Pesanan : </b>
    <div class="table-responsive mb-5">
        <table id="detail_transaksi" class="table table-striped table-bordered">
            <thead class="table-dark">
                <th class="text-center">#</th>
                <th class="text-center">Nama Buah</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga Beli</th>
                <th class="text-center">Subtotal</th>
                {{-- <th class="text-center">Aksi</th> --}}
            </thead>
            <tbody>
                @isset($detail)
                @foreach($detail as $data)
                <tr>
                    <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                    <td class="text-center align-middle" style="width: 50%">{{$data->fruit()->nama}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->jumlah}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->harga_beli}}</td>
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
    <form method="post" id="formUbah" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="foto" class="form-label"><b>Bukti Transfer : </b></label><br>
            <img id="foto" width="30%" src="{{asset('storage/img/pembelian/'.$header->foto)}}" alt=""><br>
            <input type="file" name="foto" id="inputFoto">
        </div>
        <input type="hidden" value="{{$header->id}}" name="id">
        <br><button id="ubah" type="submit" class="btn btn-primary">Ubah</button>
    </form>
@endsection
@section('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#foto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $(document).ready(function(){
        var table = $('#detail_transaksi').DataTable();
        $('#label').select2();
        $("#inputFoto").change(function() {
            readURL(this);
        });
        $('#formUbah').on('submit', function () {
            table.rows().nodes().page.len(-1).draw(); // This has the same result as above
        });
    });
</script>
@endsection

