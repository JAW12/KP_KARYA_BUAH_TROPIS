@extends('layouts.admin')
@section('title', "Tambah Transaksi Pelanggan")
@section('content')
    <a href="{{route('admin.transaksi')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Tambah Transaksi Pelanggan</h1>
    <form method="post" id="formAdd" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <div class="form-group">
                <label for="nama" class="form-label">Nama Customer</label>
                <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') ? old('nama') : ''}}">
                @error('nama')
                <div class="invalid-feedback">
                    Field nama harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="notelp" class="form-label">Nomor Telepon Customer</label>
                <input class="form-control @error('notelp') is-invalid @enderror" id="notelp" name="notelp" value="{{ old('notelp') ? old('notelp') : ''}}">
                @error('notelp')
                <div class="invalid-feedback">
                    Field nomor telepon harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat" class="form-label">Alamat Customer</label>
                <input class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') ? old('alamat') : ''}}">
                @error('alamat')
                <div class="invalid-feedback">
                    Field alamat harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                <input type="number" class="form-control @error('total_pembayaran') is-invalid @enderror" id="total_pembayaran" name="total_pembayaran" value="{{ old('total_pembayaran') ? old('total_pembayaran') : ''}}">
                @error('total_pembayaran')
                <div class="invalid-feedback">
                    Field total pembayaran harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto" class="form-label">Bukti Transfer</label><br>
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
