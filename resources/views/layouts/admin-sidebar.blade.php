<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Stok</span>
            <span><i class="fas fa-boxes"></i></span>
        </h6>
        <ul class="nav flex-column mb-2">
            @if(Auth::user()->role != 3)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.stok.bahan_baku')}}">
                    Stok Bahan Baku
                </a>
            </li>
            @endif
            @if(Auth::user()->role != 2)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.stok.produk')}}">
                    Stok Produk
                </a>
            </li>
            @endif
        </ul>

        @if(Auth::user()->role != 3)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Buah</span>
            <span><i class="fas fa-apple-alt"></i></span>
        </h6>
        @endif
        <ul class="nav flex-column mb-2">
            @if(Auth::user()->role != 3)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.permintaan')}}">
                    Permintaan Buah
                </a>
            </li>
            @endif
            @if(Auth::user()->role != 1 && Auth::user()->role != 3)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.pembelian')}}">
                    Pembelian Buah
                </a>
            </li>
            @endif
        </ul>

        @if(Auth::user()->role == 4)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Produk</span>
            <span><i class="fas fa-shopping-cart"></i></span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.master.produk')}}">
                    Master Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.master.kategori_buah')}}">
                    Master Kategori & Buah
                </a>
            </li>
        </ul>
        @endif

        @if(Auth::user()->role != 1 && Auth::User()->role != 2)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Akun</span>
            <span><i class="fas fa-user"></i></span>
        </h6>
        @endif
        <ul class="nav flex-column mb-2">
            @if(Auth::user()->role == 3 || Auth::user()->role == 4)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.transaksi')}}">
                    Transaksi Pelanggan
                </a>
            </li>
            @endif
            @if(Auth::user()->role == 4)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.master.pegawai')}}">
                    Master Pegawai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.master.banner')}}">
                    Master Banner
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
