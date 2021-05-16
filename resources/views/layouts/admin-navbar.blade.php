{{-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a id="role" class="navbar-brand col-md-3 col-lg-3 mr-0 px-3" href="{{route('admin.home')}}">[Role] - [Nama]</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</header> --}}
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand me-0 px-3" href="{{route('admin.home')}}">
        @if(Auth::user()->role == 1)
        Admin Produksi
        @elseif(Auth::user()->role == 2)
        Admin Pembelian
        @elseif(Auth::user()->role == 3)
        Admin Penjualan
        @elseif(Auth::user()->role == 4)
        Owner
        @endif - {{Auth::user()->nama}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100"></div>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{route('admin.logout')}}">Sign out</a>
        </li>
    </ul>
</header>
