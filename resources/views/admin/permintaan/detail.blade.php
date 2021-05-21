@extends('layouts.admin')
@section('title', "Detail Permintaan $header->kode")
@section('content')
    <a href="{{route('admin.permintaan')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Detail Permintaan #{{$header->kode}}</h1>
    <div class="text-left mb-3">
        <b>Tanggal Permintaan</b> : {{$header->created_at}}
    </div>
    <div class="table-responsive mb-5">
        <table id="detail_permintaan" class="table table-striped table-bordered">
            <thead class="table-dark">
                <th class="text-center">#</th>
                <th class="text-center">Nama Buah</th>
                <th class="text-center">Jumlah</th>
                @if (Auth::user()->role == "2")
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                @endif
                {{-- <th class="text-center">Aksi</th> --}}
            </thead>
            <tbody>
                @isset($detail)
                @foreach($detail as $data)
                <tr>
                    <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                    <td class="text-center align-middle" style="width: 45%">{{$data->fruit()->nama}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->jumlah}}</td>
                    {{-- <td class='text-center align-middle' style="width: 10%">
                    </td> --}}
                    @if (Auth::user()->role == "2")
                        <td class="align-middle text-center @if($data->status == 0) text-dark @elseif($data->status == 1) text-success @endif" style="width: 15%">@if($data->status == 0) Belum dibeli @elseif($data->status == 1) Sudah dibeli @endif</td>
                        <td class="text-center align-middle" style="width: 20%"><button type="submit" class="idproduk btn btn-warning" value="{{$data->id}}">Ubah Status</button></td>
                    @endif
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var table = $('#detail_permintaan').DataTable();
        $(document).on('click', '.idproduk', function(){
            $id = $(this).val();
            Swal.fire({
                title: 'Pilih status',
                input: 'select',
                inputOptions: {
                    '0': 'Belum Dibeli',
                    '1': 'Sudah Dibeli'
                },
                showCancelButton: true,
                confirmButtonText: 'Kumpul',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = `/admin/permintaan/ubahStatus/` + result.value + `/` + $id;
                }
            });
        });
    });
</script>
@endsection

