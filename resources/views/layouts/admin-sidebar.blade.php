<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Stok</span>
            <span><i class="fas fa-boxes"></i></span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.stok.bahan_baku')}}">
                    Stok Bahan Baku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.stok.produk')}}">
                    Stok Produk
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Buah</span>
            <span><i class="fas fa-apple-alt"></i></span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.permintaan')}}">
                    Permintaan Buah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Pembelian Buah
                </a>
            </li>
        </ul>

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

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Akun</span>
            <span><i class="fas fa-user"></i></span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Transaksi Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Master Pegawai
                </a>
            </li>
        </ul>
    </div>
</nav>
