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
                {{-- <th class="text-center">Aksi</th> --}}
            </thead>
            <tbody>
                @isset($detail)
                @foreach($detail as $data)
                <tr>
                    <td class="text-center align-middle" style="width: 5%">{{$loop->iteration}}</td>
                    <td class="text-center align-middle" style="width: 50%">{{$data->fruit()->nama}}</td>
                    <td class="text-center align-middle" style="width: 15%">{{$data->jumlah}}</td>
                    {{-- <td class='text-center align-middle' style="width: 10%">
                    </td> --}}
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
    });
</script>
@endsection

