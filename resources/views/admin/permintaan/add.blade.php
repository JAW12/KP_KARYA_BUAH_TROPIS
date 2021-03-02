@extends('layouts.admin')
@section('title', "Tambah Permintaan Buah")
@section('content')
    <a href="{{route('admin.permintaan')}}" class="btn btn-light btn-sm mt-3"><i class="fas fa-chevron-left"></i> Kembali</a>
    <h1 class='text-center mb-3'>Tambah Permintaan Buah</h1>
    <div class="table-responsive">
        <form method="post" id="formPermintaan">
        <table id="permintaan" class="table table-striped table-bordered">
                @csrf
                <thead class="table-dark"">
                    <th class=" text-center">#</th>
                    <th class="text-center">Nama Buah</th>
                    <th class="text-center">Jumlah</th>
                </thead>
                <tbody>
                    @isset($fruits)
                    @foreach($fruits as $data)
                    <tr>
                        <th class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</th>
                        <td class="align-middle" style="width: 30%">{{$data->nama}}</td>
                        <td class="align-middle text-center" style="width: 10%">
                            <input type="hidden" name="id[]" value="{{$data->id}}">
                            <input type="number" name="jumlah[]" class="form-control" value="0">
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
            <div class="text-right mt-3 mb-5">
                <button type="submit" class="btn btn-primary">Kumpul</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            var table = $('#permintaan').DataTable();
            $('#formPermintaan').on('submit', function () {
                table.rows().nodes().page.len(-1).draw(); // This has the same result as above
            });
        });

    </script>
@endsection

