@extends('layouts.admin')
@section('title', "Tambah Pembelian")
@section('content')
    <a href="{{route('admin.pembelian')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Tambah Pembelian</h1>
    <form method="post" id="formAdd" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <div class="form-group">
                <label for="tempat" class="form-label">Tempat Pembelian</label>
                <input class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" value="{{ old('tempat') ? old('tempat') : ''}}">
                @error('tempat')
                <div class="invalid-feedback">
                    Field tempat pembelian harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') ? old('tanggal') : ''}}">
                @error('tanggal')
                <div class="invalid-feedback">
                    Field tanggal pembelian harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="total" class="form-label">Total Pembelian</label>
                <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') ? old('total') : ''}}">
                @error('total')
                <div class="invalid-feedback">
                    Field total pembelian harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto" class="form-label">Bukti Pembayaran</label><br>
                <img id="foto" width="30%" src="{{asset('storage/img/no-image.png')}}" alt=""><br>
                <input type="file" name="foto" id="inputFoto">
            </div>
        </div>
        <button id="lanjut" type="submit" class="btn btn-primary">Lanjut</button>
        <button type="reset" id="reset" class="btn btn-danger">Reset</button>
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
        $('#label').select2();
        $("#inputFoto").change(function() {
            readURL(this);
        });
        $("#reset").click(function(){
            $("#foto").attr("src", "{{asset('storage/img/no-image.png')}}");
        });
    });
</script>
@endsection
