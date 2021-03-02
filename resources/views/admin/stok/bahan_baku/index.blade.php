@extends('layouts.admin')
@section('title', 'Stok Bahan Baku')
@section('content')
{{-- <!-- Modal -->
<div class="modal fade" id="detailModal" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="formDetail">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="detail_stok_bahan_baku">
                        <thead class="table-dark"">
                    <th class=" text-center">Tgl</th>
                            <th class="text-center">Berat</th>
                            <th class="text-center">Keterangan</th>
                        </thead>
                        <tbody id="modal-table">
                        </tbody>
                    </table>
                </div>
                <hr>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="number" class="form-control" id="berat" name="berat" value="0">
                        <div class="invalid-feedback">
                            Field berat harus diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Keterangan</label>
                        <select id="keterangan" name="keterangan" class="form-control">
                            <option value="0" selected disabled="disabled">Pilih keterangan</option>
                            <option value="1">Mentah</option>
                            <option value="1">Matang</option>
                            <option value="-1">Rusak</option>
                            <option value="-1">Selesai</option>
                        </select>
                        <div class="invalid-feedback">
                            Field keterangan harus dipilih
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="tambah" fruit_id="" type="submit" class="btn btn-primary">Kumpul</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
<h1 class="text-center mt-5 mb-3">Stok Bahan Baku</h1>
<div class="table-responsive mb-5">
    <table id="stok_bahan_baku" class="table table-striped table-bordered">
        <thead class="table-dark"">
            <th class=" text-center">#</th>
            <th class="text-center">Nama Buah</th>
            <th class="text-center">Stok Mentah</th>
            <th class="text-center">Stok Matang</th>
            <th class="text-center">Stok Rusak</th>
            <th class="text-center">Stok Selesai</th>
            <th class="text-center">Stok Akhir</th>
            <th class="text-center">Aksi</th>
        </thead>
        <tbody>
            @isset($header)
            @foreach($header as $data)
            <tr>
                <th class="align-middle text-center" style="width: 5%">{{$loop->iteration}}</th>
                <td class="align-middle" style="width: 30%">{{$data->nama}}</td>
                <td class="align-middle text-center" style="width: 10%">{{$data->mentah()}}</td>
                <td class="align-middle text-center" style="width: 10%">{{$data->matang()}}</td>
                <td class="align-middle text-center" style="width: 10%">{{$data->rusak()}}</td>
                <td class="align-middle text-center" style="width: 10%">{{$data->selesai()}}</td>
                <th class="align-middle text-center" style="width: 10%">{{$data->jumlah()}}</th>
                <td class="align-middle text-center" style="width: 20%">
                    {{-- <button id="{{$data->id}}" nama="{{$data->nama}}" class="btn btn-info col my-1 detail">
                        <i class="fas fa-info-circle mr-auto"></i>
                        Lihat Detail
                    </button> --}}
                    <a href="{{route('admin.stok.bahan_baku.detail', $data->slug)}}" class="btn btn-info col my-1">
                        <i class="fas fa-info-circle mr-auto"></i> Lihat Detail
                    </a>
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
        $('#stok_bahan_baku').DataTable();

        // $('.detail').click(function(){
        //     var id = $(this).attr('id');
        //     $('.modal-title').html("Detail " + $(this).attr('nama'));
        //     $('#tambah').attr('fruit_id', id);

        //     $.get('{{ url("detail_bahan_baku") }}',{id : id}, function(response) {
        //         var dom = null;
        //         if(response.data.length > 0){
        //             response.data.forEach(el => {
        //             if(el.keterangan == null){
        //                 dom += "<tr><td>"+el.tanggal+"</td><td>"+el.berat+"</td><td>-</td>></tr>";
        //             }
        //             else{
        //                 dom += "<tr><td>"+el.tanggal+"</td><td>"+el.berat+"</td><td>" + el.keterangan + "</td>></tr>";
        //             }
        //         });
        //             $('#modal-table').html(dom);
        //             $("#detail_stok_bahan_baku").DataTable({
        //                 "lengthChange": false,
        //                 "pageLength": 5,
        //                 retrieve: true
        //             });
        //         }
        //         else{
        //             $('#modal-table').html("");
        //             $("#detail_stok_bahan_baku").DataTable({
        //                 "lengthChange": false,
        //                 "pageLength": 5,
        //                 retrieve: true
        //             }).clear().draw();
        //         }

        //         $('#detailModal').modal('show');
        //     });
        // });

        // $("#tambah").click(function(e){
        //     e.preventDefault();
        //     var id = $(this).attr('fruit_id');
        //     var berat = $('#berat').val();
        //     var keterangan = $('#keterangan').find(':selected').text();
        //     var status = $('#keterangan').find(':selected').val();
        //     var benar = true;

        //     if(berat == ""){
        //         if($('#berat').hasClass('is-invalid')){
        //             $('#berat').removeClass('is-invalid');
        //             $('#berat').addClass('is-invalid');
        //         }
        //         else{
        //             $('#berat').addClass('is-invalid');
        //         }
        //         benar = false;
        //     }

        //     if(status == "0"){
        //         if($('#keterangan').hasClass('is-invalid')){
        //             $('#keterangan').removeClass('is-invalid');
        //             $('#keterangan').addClass('is-invalid');
        //         }
        //         else{
        //             $('#keterangan').addClass('is-invalid');
        //         }
        //         benar = false;
        //     }

        //     if (benar){
        //         var formData = {
        //             "_token": "{{ csrf_token() }}",
        //             'id'                : id,
        //             'berat'             : berat,
        //             'status'            : status,
        //             'keterangan'        : keterangan,
        //         };
        //         console.log(formData);

        //         $.ajax({
        //             type        : 'POST',
        //             data        : formData,
        //             dataType    : 'json',
        //             success: function(data) {
        //                 alert('tes');
        //             }
        //         });
        //     }
        // })
    });
</script>
@endsection
