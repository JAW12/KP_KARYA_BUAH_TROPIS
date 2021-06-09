@extends('layouts.user')
@section('title', "PT. Karya Buah Tropis - $product->nama")
@section('head')
<style>
    .greenh {
        color: #000000;
    }

    .greenh:hover {
        color: #28a745;
    }

    .blackh {
        color: #28a745;
    }

    .blackh:hover {
        color: #000000;
    }

    .product-desc {
        max-height: 300px;
        margin-bottom: -25px;
        overflow-y: auto;
    }
</style>
@endsection
@section('content')
<div class="container pb-5">
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-4 pb-3">
                <img src="{{ $product->takeImage}}" class="img-fluid" loading="lazy">
                @auth
                <div class="mt-2 d-flex justify-content-center">
                    <div class="input-group w-75">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-danger" type="button" id="minus">-</button>
                        </div>
                        <input type="number" id="jml" value="0" class="form-control text-center">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button" id="plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="mt-2 d-flex justify-content-center">
                    <button class="btn btn-warning w-75" id="add"><i class="fas fa-cart-plus"></i> Tambahkan ke keranjang</button>
                </div>
                @endauth
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                <div class="p-4 border">
                    <h5 class="text-secondary">
                    <a class="greenh"
                    href="{{route('category-products', $product->category->slug)}}">{{$product->category->nama}}</a>
                    &middot;
                    @foreach($product->fruits as $label)
                        <a class="blackh" href="{{route('label-products', $label->slug)}}">
                            {{ $label->nama}}
                        </a>
                        @endforeach
                    </h5>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                        <h1>{{$product->nama}}</h1>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="{{$product->tokopedia_url}}">
                                <img src="{{asset('storage/img/tokopedia.png')}}" style="width:50px; height:50px;" alt="">
                            </a>
                        </div>
                    </div>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Harga</dt>
                        <dd class="col-sm-9">Rp. {{ number_format($product->harga_jual, 2, ",", ".")}}</dd>

                        <dt class="col-sm-3">Isi / Jumlah</dt>
                        <dd class="col-sm-9">{{ $product->isi}}</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9" style="white-space: pre-wrap; ">{{ $product->category->keterangan }}<br><br>@foreach($product->fruits as $label){{ $label->manfaat }}@endforeach</dd>
                    </dl>
                </div>
            </div>

            <div class="col-12 text-right text-secondary">
                Terakhir diupdate {{$product->updated_at->diffForHumans()}}
            </div>
        </div>
        <div class="row mt-3">

            <div class="col-12">
                <h3>Produk Serupa</h3>
                <hr>
            </div>

            @foreach($serupa as $p)
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-4">
                <div class="card" style="min-height: 370px;">
                    <a href="{{route('product-detail', $p->slug)}}">
                        <img src="{{ $p->takeImage }}" style="max-height: 250px;;object-fit: contain" loading="lazy"
                            class="card-img-top p-3" alt="...">
                    </a>

                    <div class="card-body">
                        <div>
                            <a href="{{ route('category-products', $p->category->slug) }}"
                                class="text-secondary small">
                                {{$p->category->nama}}
                            </a>
                            -
                            @foreach($p->fruits as $label)
                            <a href="{{ route('label-products', $label->slug) }}" class="text-secondary small">
                                {{ $label->nama }}
                                @if(!$loop->last)
                                &middot;
                                @endif
                            </a>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between">
                            <h5 style="max-width: 75%">
                                <a href="{{ route('product-detail', $p->slug)}}" class="card-title text-dark">
                                    {{$p->nama}}
                                </a>
                            </h5>
                            <h6>
                                {{$p->isi}}
                            </h6>
                        </div>

                        <div class="text-secondary">
                            {{ Str::limit($p->deskripsi, 25) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    $(function(){
        $("#minus").click(function(){
            let c = $("#jml").val();
            c--;
            $("#jml").val(c);
        })
        $("#plus").click(function(){
            let c = $("#jml").val();
            c++;
            $("#jml").val(c);
        })

        $("#add").click(function(){
            let c = $("#jml").val();
            $.ajax({
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id": "{{$product->id}}",
                    "jml":c
                },
                success:function(response) {
                    console.log(response);
                    if(response.status == "Success"){
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil menambahkan produk ke keranjang!',
                        })
                    }
                    else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menambahkan produk ke keranjang!',
                        })
                    }
                    $(".cart-circle").attr("data-count", response.count);
                }
            });
        })
    });
</script>
@endsection
