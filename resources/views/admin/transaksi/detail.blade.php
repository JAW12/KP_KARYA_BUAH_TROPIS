@extends('layouts.admin')
@section('title', "Detail Transaksi $header->id")
@section('content')
    <a href="{{route('admin.transaksi')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail Transaksi #{{$header->id}}</h1>
    <div class="text-left mb-3">
        <b>Tanggal Transaksi</b> : {{$header->created_at}} <br>
        @foreach ($customer as $item)
            @if($header->user_id == $item->id)
                @if ($item->role == 0)
                <b>Nama Customer</b> : {{$item->nama}} <br>
                <b>Nomor Telepon</b> : {{$item->telp}} <br>
                <b>Alamat Customer</b> : {{$item->alamat}}
                @else
                <?php
                    $pieces = explode("-", $header->keterangan);
                    echo "<b>" . "Nama Customer " . "</b> : " . $pieces[0] . "<br>";
                    echo "<b>" . "Nomor Telepon " . "</b> : " . $pieces[1] . "<br>";
                    echo "<b>" . "Alamat Customer " . "</b> : " . $pieces[2];
                ?>
                @endif
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
    <form method="post" id="formUbah" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="status" class="form-label"><b>Status :</b></label>
            <select name="status" id="status" class="mb-2 form-control">
                <option value="-1"<?=$header->status == '-1' ? ' selected="selected"' : '';?>>Dibatalkan</option>
                <option value="0"<?=$header->status == '0' ? ' selected="selected"' : '';?>>Belum dibayar</option>
                <option value="1"<?=$header->status == '1' ? ' selected="selected"' : '';?>>Lunas</option>
                <option value="2"<?=$header->status == '2' ? ' selected="selected"' : '';?>>Sedang diproses</option>
                <option value="3"<?=$header->status == '3' ? ' selected="selected"' : '';?>>Selesai</option>
            </select>
        </div><br>
        <div class="form-group">
            <label for="foto" class="form-label"><b>Bukti Transfer : </b></label><br>
            <img id="foto" width="30%" src="{{asset('storage/img/transaksi/'.$header->bukti)}}" alt=""><br>
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

