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
            <div class="text-center mb-2">
                <img id="foto" width="30%" src="{{asset('storage/img/no-image.png')}}" alt=""><br>
                <input type="file" name="foto" id="inputFoto">
            </div>

            <div class="form-group">
                <label for="harga_jual" class="form-label">Harga Produk</label>
                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') ? old('harga_jual') : ''}}">
                @error('harga_jual')
                <div class="invalid-feedback">
                    Field harga harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id" class="form-label">Kategori Produk</label>
                <select name="category_id" id="category_id" class="mb-2 form-control">
                    @foreach($category as $c)
                        <option value="{{$c->id}}">{{$c->nama}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                    Field nama harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="label" class="form-label">Label Produk</label>
                <select name="label[]" id="label" class="mb-2 form-control select2" multiple>
                    @foreach($fruits as $f)
                        <option value="{{$f->id}}">{{$f->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="mb-2 form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi') ? old('nama') : ''}}</textarea>
                @error('deskripsi')
                <div class="invalid-feedback">
                    Field deskripsi harus diisi
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tokopedia_url" class="form-label">Tokopedia URL</label>
                <input class="form-control @error('tokopedia_url') is-invalid @enderror" id="tokopedia" name="tokopedia_url" value="{{ old('tokopedia_url') ? old('tokopedia_url') : ''}}">
                @error('tokopedia_url')
                <div class="invalid-feedback">
                    Field url tokopedia harus diisi
                </div>
                @enderror
            </div>
        </div>
        <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
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
