<header class="header-style-1 bg-success" style="box-shadow: 0px -5px 15px">
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li class="">
                            <a href="{{route('about')}}" class="">
                                <i class="fas fa-info-circle"></i> Tentang
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('contact')}}" class="">
                                <i class="fas fa-phone-alt"></i> Kontak
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('product-list')}}" class="">
                                <i class="fas fa-apple-alt"></i> Produk
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('gallery')}}" class="">
                                <i class="fas fa-images"></i> Galeri
                            </a>
                        </li>
                        @auth
                        <li class="">
                            <a href="{{route('carts')}}" class="">
                                <i class="fas fa-shopping-cart"></i> Keranjang
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('transactions')}}" class="">
                                <i class="fas fa-receipt"></i> Transaksi
                            </a>
                        </li>
                        @endauth
                        @guest
                        <li class="">
                            <a href="{{route('login')}}" class="">
                                <i class="fas fa-lock"></i> Login
                            </a>
                        </li>
                        @endguest
                        @auth
                        <li class="">
                            <a href="{{route('profile')}}" class="">
                                <i class="fas fa-user"></i> Akun Saya
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('logout')}}" class="">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 logo-holder">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src=" {{ asset('storage/img/logo.png')}}" alt="logo" class="p-3 rounded" style="width:50%; background-color: rgb(300, 300, 300)">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2"></div>
                <div class="col-xs-12 col-sm-12 col-md-5 top-search-holder mt-xs-0 mt-md-4">
                    <div class="search-area">
                        <form id="formSearch" action="{{route('search.products')}}" method="get">
                            <div class="control-group">
                                <input class="search-field" name="query" placeholder="Search here...">
                                <button class="btn fa search-button" style="padding-bottom: 13px" href="#"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="info-row">
    <div class="container">
        <div class="info-boxes wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="info-boxes-inner">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="icon-img">
                                <i class="fas fa-phone-square-alt"></i>
                            </div>
                            <br>
                            <div class="icon-text">
                                <h4 class="info-box-heading text-dark">
                                    Kontak / Pemesanan Via Wa 085105009300
                                </h4>
                            </div>
                            <a href="https://wa.me/6285105009300" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="icon-img">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <br>
                            <div class="icon-text">
                                <h4 class="info-box-heading text-dark">
                                    Jl. Lebak Indah Asri 2 No. 34, Surabaya
                                </h4>
                            </div>
                            <a href="https://goo.gl/maps/BEh4CmpuWsdM6fiTA" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="info-box">
                            <div class="icon-img">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <br>
                            <div class="icon-text">
                                <h4 class="info-box-heading text-dark">
                                    @gudangbuahbeku
                                </h4>
                            </div>
                            <a href="https://www.instagram.com/gudangbuahbeku/" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
