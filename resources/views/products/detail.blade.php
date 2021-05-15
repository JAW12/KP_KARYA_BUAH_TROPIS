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
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                <div class="p-4 border">
                    <h5 class="text-secondary">
                    <a class="greenh"
                    href="{{route('category-products', $product->category->slug)}}">{{$product->category->nama}}</a>
                    &middot;
                    @foreach($product->fruits as $label)
                    <a href="{{route('label-products', $label->slug)}}">
                        <span class="text-secondary">
                            {{ $label->nama}}</span>
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
                        <dt class="col-sm-3">Isi / Jumlah</dt>
                        <dd class="col-sm-9">{{ $product->isi}}</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9" style="white-space: pre-wrap; ">{{ $product->category->keterangan }}<br><br>@foreach($product->fruits as $label){{ $label->manfaat }}@endforeach</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="row mt-3">

            <div class="col-12">
                <h3>Produk Serupa</h3>
                <hr>
            </div>

            @foreach($serupa as $product)
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-4">
                <div class="card" style="min-height: 370px;">
                    <a href="{{route('product-detail', $product->slug)}}">
                        <img src="{{ $product->takeImage }}" style="max-height: 250px;;object-fit: contain" loading="lazy"
                            class="card-img-top p-3" alt="...">
                    </a>

                    <div class="card-body">
                        <div>
                            <a href="{{ route('category-products', $product->category->slug) }}"
                                class="text-secondary small">
                                {{$product->category->nama}}
                            </a>
                            -
                            @foreach($product->fruits as $label)
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
                                <a href="{{ route('product-detail', $product->slug)}}" class="card-title text-dark">
                                    {{$product->nama}}
                                </a>
                            </h5>
                            <h6>
                                {{$product->isi}}
                            </h6>
                        </div>

                        <div class="text-secondary">
                            {{ Str::limit($product->deskripsi, 25) }}
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
@endsection
