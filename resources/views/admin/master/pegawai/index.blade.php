@extends('layouts.admin')
@section('title', 'Master Pegawai')
@section('content')
<h1 class="text-center mt-5 mb-3">Master Pegawai</h1>
<div class="text-right mb-3">
    <a href="{{route('admin.master.pegawai.tambah')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah</a>
</div>
<div class="table-responsive mb-5">
    <table id="master_pegawai" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class="text-center">#</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Username</th>
            <th class="text-center">Sebagai</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
                @foreach($header as $data)
                <tr>
                    <th class="align-middle text-center" style="width: 10%">{{$loop->iteration}}</th>
                    <td class="align-middle" style="width: 35%">{{$data->nama}}</td>
                    <td class="align-middle" style="width: 20%">{{$data->username}}</td>
                    <td class="align-middle" style="width: 10%">
                        @if($data->role == 1)
                            Produksi
                        @elseif($data->role ==2)
                            Pembelian
                        @elseif($data->role ==3)
                            Penjualan
                        @else
                            Owner
                        @endif
                    </td>
                    <td class="align-middle text-center row gx-1">
                        <div class="col">
                            <a href="{{route('admin.master.pegawai.detail', $data->username)}}" class="btn btn-info w-100 my-1">
                                <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                            </a>
                        </div>
                        @if($data->role <> 4)
                            <div class="col">
                            @if($data->deleted_at == null)
                            <a href="{{route('admin.master.pegawai.hapus', $data->id)}}" class="btn btn-danger w-100 my-1">
                                <i class="fas fa-trash mr-auto"></i> Hapus
                            </a>
                            @else
                            <a href="{{route('admin.master.pegawai.restore', $data->id)}}" class="btn btn-success w-100 my-1">
                                <i class="fas fa-trash-restore mr-auto"></i> Kembalikan
                            </a>
                            @endif
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
    $(document).ready( function () {
            $('#master_pegawai').DataTable();
        });
</script>
@endsection
