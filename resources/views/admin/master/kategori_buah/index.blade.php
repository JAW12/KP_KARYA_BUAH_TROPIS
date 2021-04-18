@extends('layouts.admin')
@section('title', 'Master Kategori & Buah')
@section('content')
<div class="row">
    <div class="col-6">
        <h1 class="text-center mt-5 mb-3">Master Kategori</h1>
        <div class="text-right mb-3">
            <a href="{{route('admin.master.kategori.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
        </div>
            <div class="table-responsive mb-5">
                <table id="master_kategori" class="table table-striped table-bordered">
                    <thead class="table-dark"">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @isset($kategori)
                            @foreach($kategori as $data)
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                                <td class="align-middle text-center" style="width: 30%">{{$data->nama}}</td>
                                <td class="align-middle text-center" style="width: 20%">
                                    <a href="{{route('admin.master.kategori.detail', $data->slug)}}" class="btn btn-warning col my-1">
                                        <i class="fas fa-edit mr-auto"></i> Ubah
                                    </a>
                                    @if($data->deleted_at == null)
                                    <a href="{{route('admin.master.kategori.hapus', $data->id)}}" class="btn btn-danger col my-1">
                                        <i class="fas fa-trash mr-auto"></i> Hapus
                                    </a>
                                    @else
                                    <a href="{{route('admin.master.kategori.restore', $data->id)}}" class="btn btn-success col my-1">
                                        <i class="fas fa-trash-restore mr-auto"></i> Kembalikan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
    </div>
    <div class="col-6">
        <h1 class="text-center mt-5 mb-3">Master Buah</h1>
        <div class="text-right mb-3">
            <a href="{{route('admin.master.buah.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
        </div>
            <div class="table-responsive mb-5">
                <table id="master_buah" class="table table-striped table-bordered">
                    <thead class="table-dark"">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @isset($buah)
                            @foreach($buah as $data)
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                                <td class="align-middle text-center" style="width: 30%">{{$data->nama}}</td>
                                <td class="align-middle text-center" style="width: 20%">
                                    <a href="{{route('admin.master.buah.detail', $data->slug)}}" class="btn btn-warning col my-1">
                                        <i class="fas fa-edit mr-auto"></i> Ubah
                                    </a>
                                    @if($data->deleted_at == null)
                                    <a href="{{route('admin.master.buah.hapus', $data->id)}}" class="btn btn-danger col my-1">
                                        <i class="fas fa-trash mr-auto"></i> Hapus
                                    </a>
                                    @else
                                    <a href="{{route('admin.master.buah.restore', $data->id)}}" class="btn btn-success col my-1">
                                        <i class="fas fa-trash-restore mr-auto"></i> Kembalikan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready( function () {
        $('#master_kategori').DataTable({
            pageLength: 5
        });
        $('#master_buah').DataTable({
            pageLength: 5
        });
    });
</script>
@endsection
