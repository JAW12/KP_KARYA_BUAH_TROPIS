@extends('layouts.admin')
@section('title', "Stok Produk - $header->nama")
@section('content')
    <a href="{{route('admin.stok.produk')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Stok {{$header->nama}}</h1>
    <div class="row">
        <div class="col-sm-12 col-xl-6">
            <div class="table-responsive mb-5">
                <table id="detail_produk" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <th class="text-center">Tgl</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </thead>
                    <tbody>
                        @isset($detail)
                        @foreach($detail as $data)
                        <tr>
                            <td class="text-center align-middle" style="width: 30%">{{$data->created_at}}</td>
                            <td class="text-center align-middle" style="width: 10%">{{$data->jumlah}}</td>
                            <td class='align-middle
                            @if($data->keterangan == 'Hilang' || $data->keterangan == 'Rusak')
                            text-danger
                            @elseif($data->keterangan == 'Produksi')
                            text-success
                            @elseif($data->keterangan == 'Penjualan')
                            text-primary
                            @endif' style="width: 55%">{{$data->keterangan}}</td>
                            <td class='text-center align-middle' style="width: 5%">
                                <a href="{{route('admin.stok.produk.hapus', $data->id)}}" class="btn btn-danger">
                                    <i class="fas fa-trash-alt mr-auto"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <h4>Stok Akhir: <span class="badge badge-secondary">{{$header->jumlah()}}</span></h4>
            <form method="post" id="formDetail">
                @csrf
                <div class="mt-3">
                    <input type="hidden" name="id" value="{{$header->id}}">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ (old('jumlah') != null) ? old('jumlah') : 0}}">
                    @error('jumlah')
                    <div class="invalid-feedback">
                        Field jumlah harus diisi
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                        <option value="0" selected disabled="disabled">Pilih keterangan</option>
                        <option value="Produksi" {{ 'Produksi' === old('keterangan') ? 'selected' : '' }}>Produksi</option>
                        <option value="Hilang" {{ 'Hilang' === old('keterangan') ? 'selected' : '' }}>Hilang</option>
                        <option value="Rusak" {{ 'Rusak' === old('keterangan') ? 'selected' : '' }}>Rusak</option>
                        <option value="Terjual" {{ 'Terjual' === old('keterangan') ? 'selected' : '' }}>Terjual</option>
                    </select>
                    @error('keterangan')
                    <div class="invalid-feedback">
                        Field keterangan harus diisi
                    </div>
                    @enderror
                </div>
                <button id="tambah" fruit_id="" type="submit" class="btn btn-primary">Kumpul</button>
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
    });
</script>
@endsection

