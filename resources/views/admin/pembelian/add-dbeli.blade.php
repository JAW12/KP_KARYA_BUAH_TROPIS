@extends('layouts.admin')
@section('title', "Tambah buah yang dibeli")
@section('content')
    <h1 class='text-center mb-3'>Tambah buah yang dibeli</h1>
    <div class="table-responsive">
        <form method="post" id="formTransaksi">
            <div class="form-group">
                <label for="idtrans" class="form-label">ID Pembelian</label>
                <input class="form-control" id="idtrans" name="idtrans" value="{{$idtrans}}" disabled><br>
            </div>
        <table id="permintaan" class="table table-striped table-bordered">
                @csrf
                <thead class="table-dark"">
                    <th class=" text-center">#</th>
                    <th class="text-center">Nama Buah</th>
                    <th class="text-center">Jumlah (kg)</th>
                    <th class="text-center">Harga Beli</th>
                </thead>
                <tbody>
                    @isset($fruits)
                    @foreach($fruits as $data)
                    <tr>
                        <th class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</th>
                        <td class="align-middle" style="width: 30%">{{$data->nama}}</td>
                        <td class="align-middle text-center" style="width: 10%">
                            <input type="hidden" name="fruit[{{$data->id}}]" value="{{$data->id}}">
                            <input type="hidden" name="idtrans" value="{{$idtrans}}">
                            <input type="number" name="fruit[{{$data->id}}][jumlah]" class="form-control" value="0">
                        </td>
                        <td class="align-middle text-center" style="width: 10%">
                            <input type="number" name="fruit[{{$data->id}}][harga_beli]" class="form-control" value="0">
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
            <div class="text-right mt-3 mb-5">
                <button type="submit" class="btn btn-primary">Kumpul</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
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
        var table = $('#permintaan').DataTable();
        $('#formTransaksi').on('submit', function () {
            table.rows().nodes().page.len(-1).draw(); // This has the same result as above
        });
    });
</script>
@endsection
