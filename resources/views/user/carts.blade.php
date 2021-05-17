@extends('layouts.user')
@section('title', 'PT. Karya Buah Tropis - Keranjang Anda')
@section('content')
    <div class="container pt-3">
        @include('layouts.alert')
        <h3>Keranjang Anda</h3>
        <div class="table-responsive mb-5">
            <table id="" class="table table-hover table-striped table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(Auth::user()->carts as $cart)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td style="width:20%"><img src="{{$cart->takeImage}}" style="object-fit: cover" class="img-fluid" alt="{{$cart->nama}}"></td>
                            <td>{{$cart->nama}}</td>
                            <td>Rp. {{number_format($cart->harga_jual, 2, ",", ".")}}</td>
                            <td style="width:20">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{route('carts.kurang', $cart->id)}}" class="btn btn-outline-dark mx-2" style="width:35px; height:35px;">-</a>
                                    {{$cart->pivot->jumlah}}
                                    <a href="{{route('carts.tambah', $cart->id)}}" class="btn btn-outline-dark mx-2" style="width:35px; height:35px;">+</a>
                                </div>
                            </td>
                            <td>Rp. {{number_format($cart->harga_jual * $cart->pivot->jumlah, 2, ",", ".")}}</td>
                            <td><a class="btn btn-danger col my-1" href="{{route('carts.hapus', $cart->id)}}">
                                <i class="fas fa-trash mr-auto"></i> Hapus
                            </a></td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Keranjang kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($total > 0)
            <div class="d-flex align-items-end justify-content-end">
                <h5 class="mr-3">Total: Rp. {{number_format($total, 2, ",", ".")}}</h5>
                <a href="{{route('carts.checkout')}}" class="btn btn-dark">Pesan</a>
            </div>
            @endif
        </div>
    </div>
@endsection
