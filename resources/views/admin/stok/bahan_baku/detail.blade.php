@extends('layouts.admin')
@section('title', "Stok Bahan Baku - $header->nama")
@section('content')
    <a href="{{route('admin.stok.bahan_baku')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Stok {{$header->nama}}</h1>
    <div class="row">
        <div class="col-sm-12 col-xl-6">
            <div class="table-responsive mb-5">
                <table id="detail_bahan_baku" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <th class="text-center">Tgl</th>
                        <th class="text-center">Berat</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </thead>
                    <tbody>
                        @isset($detail)
                        @foreach($detail as $data)
                        <tr>
                            <td class="text-center align-middle" style="width: 30%">{{$data->created_at}}</td>
                            <td class="text-center align-middle" style="width: 10%">{{$data->berat}}</td>
                            <td class='align-middle
                            @if($data->keterangan == 'Mentah')
                            text-secondary
                            @elseif($data->keterangan == 'Matang')
                            text-success
                            @elseif($data->keterangan == 'Rusak')
                            text-danger
                            @elseif($data->keterangan == 'Selesai')
                            text-primary
                            @endif' style="width: 55%">{{$data->keterangan}}</td>
                            <td class='text-center align-middle' style="width: 5%">
                                <a href="{{route('admin.stok.bahan_baku.hapus', $data->id)}}" class="btn btn-danger">
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
            <div class="d-flex justify-content-xl-start justify-content-sm-center">
                <button id="mentah" class="btn btn-secondary mx-1 btn-sm">
                    Mentah <span class="badge bg-light text-dark">{{$header->mentah()}}</span>
                </button>
                <button id="matang" class="btn btn-success mx-1 btn-sm">
                    Matang <span class="badge bg-light text-dark">{{$header->matang()}}</span>
                </button>
                <button id="rusak" class="btn btn-danger mx-1 btn-sm">
                    Rusak <span class="badge bg-light text-dark">{{$header->rusak()}}</span>
                </button>
                <button id="selesai" class="btn btn-primary mx-1 btn-sm">
                    Selesai <span class="badge bg-light text-dark">{{$header->selesai()}}</span>
                </button>
                <button id="jumlah" class="btn btn-dark mx-1 btn-sm">
                    Stok Akhir <span class="badge bg-light text-dark">{{$header->jumlah()}}</span>
                </button>
            </div>
            <form method="post" id="formDetail">
                @csrf
                <div class="mt-5">
                    <input type="hidden" name="id" value="{{$header->id}}">
                    <label for="berat" class="form-label">Berat</label>
                    <input type="number" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" value="{{ (old('berat') != null) ? old('berat') : 0}}">
                    @error('berat')
                    <div class="invalid-feedback">
                        Field berat harus diisi
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                        <option value="0" selected disabled="disabled">Pilih keterangan</option>
                        <option value="Mentah" {{ 'Mentah' === old('keterangan') ? 'selected' : '' }}>Mentah</option>
                        <option value="Matang" {{ 'Matang' === old('keterangan') ? 'selected' : '' }}>Matang</option>
                        <option value="Rusak" {{ 'Rusak' === old('keterangan') ? 'selected' : '' }}>Rusak</option>
                        <option value="Selesai" {{ 'Selesai' === old('keterangan') ? 'selected' : '' }}>Selesai</option>
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
        var table = $('#detail_bahan_baku').DataTable({
            "order":[]
        });

        $("#mentah").click(function(){
            table
                .column(2)
                .search('Mentah')
                .draw();
        });

        $("#matang").click(function(){
            table
                .column(2)
                .search('Matang')
                .draw();
        });

        $("#rusak").click(function(){
            table
                .column(2)
                .search('Rusak')
                .draw();
        });

        $("#selesai").click(function(){
            table
                .column(2)
                .search('Selesai')
                .draw();
        });

        $("#jumlah").click(function(){
            table
            .search( '' )
            .columns().search( '' )
            .draw();
        });
    });
</script>
@endsection

