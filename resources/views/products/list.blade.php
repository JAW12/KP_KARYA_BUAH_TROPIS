@extends('layouts.user')
@section('title', 'PT. Karya Buah Tropis - Produk')
@section('head')
<style>
    .greenh {
        color: #000000;
    }

    .greenh:hover {
        color: #28a745;
    }
</style>
@endsection
@section('content')
<div class="container pb-5">
    <div>
        @isset($category)
        <h1>Kategori: {{$category->nama}}</h1>
        @endisset

        @isset($label)
        <h1>Buah: {{$label->nama}}</h1>
        @endisset

        @if(!isset($label) && !isset($category))
        <h1>Produk</h1>
        @endif
        <hr>
    </div>
    @isset($query)
    <div class="text-secondary h6 mb-2">
        {{ $products->total() }} hasil penelusuran dari "{{$query}}" yang ditemukan.
    </div>
    @endisset
    <div class="row">
        @foreach($products as $product)
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-4">
            <div class="card" style="min-height: 370px;">
                <div style="height:250px;" class="d-flex">
                    <a href="{{route('product-detail', $product->slug)}}" class="my-auto">
                        <img src="{{ $product->takeImage }}" style="max-height: 250px;object-fit: contain;" loading="lazy"
                            class="card-img-top p-3" alt="...">
                    </a>
                </div>
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
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $products->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection
