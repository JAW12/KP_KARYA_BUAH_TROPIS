@extends('layouts.user')
@section('title', 'Karya Buah Tropis - Tentang Kami')
@section('head')
@endsection
@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-12">
            <h1>Tentang Kami</h1>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 mb-4">
            <img src="{{ asset('storage/img/about1.jpg')}}" class="img-fluid w-100" alt="">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 my-auto">
            <h4>Visi</h4>
            <p class="text-justify">Menjadi perusahaan yang bisa partner untuk pelaku usaha yang membutuhkan buah -
                buahan kualitas premium.</p>

            <h4>Misi</h4>
            <p class="text-justify">Menyediakan buah - buahan fresh yang dibekukan untuk kebutuhan Industri, Hotel,
                Resto, Kafe dan pengguna pribadi.</p>
        </div>
        <div class="col-12">
            <hr>
            <h4>Siapa kami?</h4>
            <div class="row">
                <div class="col-xs-12 col-lg-6 mx-auto">
                    <img src="{{ asset('storage/img/about2.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>

            <p class="text-justify mt-2" style="text-indent: 2em">Kami adalah perusahaan yang bergerak di bidang buah -
                buahan yang
                terpilih dan
                diproses dengan cara professional dan higienis menjadi sebuah produk buah frozen yang bisa disimpan
                dalam waktu yang lama dan digunakan dengan cara yang praktis untuk kebutuhan Industri, Hotel, Resto,
                Kafe dan pengguna pribadi yang mempunyai selera dan standar kualitas yang premium.</p>

        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
