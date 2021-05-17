@extends('layouts.user')
@section('title', 'PT. Karya Buah Tropis - Home')
@section('head')
<style>
    .greenh:hover {
        color: #28a745;
    }
</style>
@endsection
@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
            <div class="side-menu animate-dropdown outer-bottom-xs">
                <div class="head">
                    <i class="icon fa fa-align-justify fa-fw"></i>
                    Kategori
                </div>
                <nav class="yamm megamenu-horizontal">
                    <ul class="nav">
                        @foreach($categories as $category)
                        <li class="d-flex">
                            <a href="{{ route('category-products', $category->slug) }}" class="w-100">
                                {{$category->nama}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="hero">
                <div id="banner" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#banner" data-slide-to="0" class="active"></li>
                        <li data-target="#banner" data-slide-to="1"></li>
                        <li data-target="#banner" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/img/no-image.png')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/img/no-image.png')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/img/no-image.png')}}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="box-top-banner mt-5 mb-4">
            <div>
                <h1>PUNYA MASALAH BERIKUT?</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 imgbox">
                        <div style="width:100%; height:300px; overflow:hidden;">
                            <img src="{{asset('storage/img/home1.jpg')}}" style="margin-top: -100px;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box-cont-box" style="padding-bottom: 25px">
                        <h3>
                            <span>Penggunaan</span>
                        </h3>
                        <h6> buah mudah rusak, sulit disimpan, ribet pas mau pakai?</h6>
                        <div class="box-line-bg"></div>
                        <p>Kami menawarkan produk yang mampu bertahan cukup lama (dalam proses penyimpanan), mudah
                            disimpan dan mudah dikonsumsi.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 imgbox">
                        <div style="width:100%; height:300px; overflow:hidden;">
                            <img src="{{asset('storage/img/home2.jpg')}}" style="margin-top: -50px;" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box-cont-box" style="padding-bottom: 25px">
                        <h3><span>Stok</span></h3>
                        <h6>bergantung musiman, kalau ga musim ya ga dapat buahnya?</h6>
                        <div class="box-line-bg"></div>
                        <p>Tenang! Kami menyediakan 30+ stok buah beku ready! Tidak lagi terbatas oleh musiman, walau
                            tidak musim kami ada!</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 imgbox">
                        <div style="width:100%; height:300px; overflow:hidden;">
                            <img src="{{asset('storage/img/home3.jpg')}}" style="margin-top: -50px;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box-cont-box" style="padding-bottom: 25px">
                        <h3><span>Kualitas</span></h3>
                        <h6>bingung cari yang bagus seperti apa? Dapatnya selalu jelek terus?</h6>
                        <div class="box-line-bg"></div>
                        <p>Kami berusaha memberikan kualitas terbaik kepada Anda dengan proses pengerjaan yang
                            profesional dan
                            higienis!</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp;">
            <div class="more-info-tab clearfix more-danger-tab">
                <h3 class="new-product-title pull-left bg-danger">Produk Terbaru</h3>
            </div>
            <div class="tab-content border-bottom-0">
                <div class="row mx-0">
                    @foreach($terbaru as $t)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 p-0">
                        <div class="card">
                            <a href="{{route('product-detail', $t->slug)}}">
                                <img src="{{$t->takeImage}}" class="card-img-top p-3"
                                    style="max-height: 250px;object-fit: contain">
                            </a>
                            <div class="card-body">
                                <div>
                                    <a href="{{ route('category-products', $t->category->slug) }}"
                                        class="text-secondary small">
                                        {{$t->category->nama}}
                                    </a>
                                    -
                                    @foreach($t->fruits as $label)
                                    <a href="{{ route('label-products', $label->slug) }}" class="text-secondary small">
                                        {{$label->nama}}
                                    </a>
                                    @endforeach
                                </div>

                                <h5>
                                    <a href="{{route('product-detail', $t->slug)}}" class="card-title text-dark">
                                        {{$t->nama}}
                                    </a>
                                </h5>

                                <div class="text-secondary my-2">
                                    {{ Str::limit($t->deskripsi, 50) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp;">
            <div class="more-info-tab clearfix">
                <h3 class="new-product-title pull-left">Produk Terlaris</h3>
            </div>
            <div class="tab-content border-bottom-0">
                <div class="row mx-0">
                    @foreach($terlaris as $t)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 p-0">
                        <div class="card">
                            <a href="{{route('product-detail', $t->slug)}}">
                                <img src="{{$t->takeImage}}" class="card-img-top p-3"
                                    style="max-height: 250px;object-fit: contain">
                            </a>
                            <div class="card-body">
                                <div>

                                    <a href="{{ route('category-products', $t->category->slug) }}"
                                        class="text-secondary small">
                                        {{$t->category->nama}}
                                    </a>
                                    -
                                    @foreach($t->fruits as $label)
                                    <a href="{{ route('label-products', $label->slug) }}" class="text-secondary small">
                                        {{$label->nama}}
                                    </a>
                                    @endforeach
                                </div>

                                <h5>
                                    <a href="{{route('product-detail', $t->slug)}}" class="card-title text-dark">
                                        {{$t->nama}}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
</script>
@endsection
