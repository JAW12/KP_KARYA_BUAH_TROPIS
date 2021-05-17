@extends('layouts.admin')
@section('title', "Detail Produk - $header->nama")
@section('content')
    <a href="{{route('admin.master.produk')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail {{$header->nama}}</h1>
    <div class="row pb-5">
        <div class="col-sm-12 col-xl-6">
            <form method="post" id="formGambar" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$header->id}}">
                <img class="img-fluid img-thumbnail" src="{{asset('storage/img/products/'.$header->foto)}}"  alt="">
                <div class="text-center mt-3">
                    <input type="file" name="foto" id="foto">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="table-responsive">
                <table id="detail_produk" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <th class="text-center">Tgl</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Subtotal</th>
                    </thead>
                    <tbody>
                        @isset($detail)
                        @foreach($detail as $data)
                        <tr>
                            <td class="text-center align-middle" style="width: 30%">{{$data->created_at}}</td>
                            <td class="text-center align-middle" style="width: 10%">{{$data->jumlah}}</td>
                            <td class="text-center align-middle" style="width: 10%">{{number_format($data->harga_jual, 2, ",", "."")}}</td>
                            <td class="text-center align-middle" style="width: 10%">{{$data->subtotal}}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                <h4>Total Penjualan: {{$detail->sum('subtotal')}}</h4>
            </div>
            <hr>
            <h4>Edit</h4>
            <form method="post" id="formDetail">
                @csrf
                <div class="mb-2">
                    <input type="hidden" name="id" value="{{$header->id}}">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $header->nama ? $header->nama : ''}}">
                        @error('nama')
                        <div class="invalid-feedback">
                            Field nama harus diisi
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category" class="form-label">Kategori Produk</label>
                        <select name="category" id="category" class="mb-2 form-control">
                            @foreach($category as $c)
                                <option value="{{$c->id}}" @if($c->id == $header->category_id) selected @endif>{{$c->nama}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">
                            Field nama harus diisi
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="label" class="form-label">Label Produk</label>
                        <select name="label[]" id="label" class="mb-2 form-control select2" multiple>
                            @foreach($fruits as $f)
                                @php $ada = false @endphp
                                @foreach($header->fruits as $fr)
                                    @if($f->id == $fr->id)
                                        @php $ada = true @endphp
                                    @endif
                                @endforeach
                                <option value="{{$f->id}}" @if($ada == true) selected @endif>{{$f->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="mb-2 form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ $header->deskripsi ? $header->deskripsi : ''}}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            Field deskripsi harus diisi
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tokopedia" class="form-label">Tokopedia URL</label>
                        <input class="form-control @error('tokopedia') is-invalid @enderror" id="tokopedia" name="tokopedia" value="{{ $header->tokopedia_url ? $header->tokopedia_url : ''}}">
                        @error('tokopedia')
                        <div class="invalid-feedback">
                            Field tokopedia harus diisi
                        </div>
                        @enderror
                    </div>
                </div>
                <button id="ubah" type="submit" class="btn btn-primary">Kumpul</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var table = $('#detail_produk').DataTable({
            "order":[]
        });
        $('#label').select2();
    });
</script>
@endsection

