@extends('layouts.user')
@section('title', 'Gudang Buah Beku - Kontak')
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
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success')}}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error')}}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <h1>Kontak Kami</h1>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 mb-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.9862413153483!2d112.7795694148599!3d-7.242403894771978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9d7e2b2b055%3A0xf6369008f60c36b5!2sGudang%20Buah%20Beku!5e0!3m2!1sen!2sid!4v1599540765789!5m2!1sen!2sid"
                class="w-100" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 mt-auto">
            <dl class="row">
                <dt class="col-sm-3"><i class="fas fa-map-marker-alt"></i> Lokasi Gudang</dt>
                <dd class="col-sm-9">Jl. Lb. Indah Asri II No.34, Gading, Kec. Tambaksari, Kota SBY, Jawa Timur 60134
                </dd>

                <dt class="col-sm-3"><i class="fas fa-phone-alt"></i> Kontak (Whatsapp)</dt>
                <dd class="col-sm-9">
                    (+62) 085105009300
                </dd>

                <dt class="col-sm-3"><i class="far fa-envelope"></i> Email</dt>
                <dd class="col-sm-9"><a href="mailto:karyabuahtropis@gmail.com"
                        class="greenh">karyabuahtropis@gmail.com</a>
                </dd>

            </dl>
        </div>
        <div class="col-12">
            <hr>
            <h3 class="text-center">Mau berkunjung?</h3>
            <form class="row" action="{{route('send')}}" method="post">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama" required>
                        <div class="invalid-feedback">
                            Nama harap diisi
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                        <div class="invalid-feedback">
                            Email harap diisi
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telp">No.Telp</label>
                        <input class="form-control" type="tel" name="telp" id="telp" required>
                        <div class="invalid-feedback">
                            No.Telp harap diisi
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="tgl">Waktu Berkunjung</label>
                        <input class="form-control" type="datetime-local" name="tgl" id="tgl" required>
                        <div class="invalid-feedback">
                            Waktu berkunjung harap diisi
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan Anda</label>
                        <textarea class="form-control" name="pesan" id="pesan" style="resize: none;"
                            rows="5"></textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <div class="text-secondary">
                        Anda akan dikontak lebih lanjut apabila kunjungan Anda disetujui.
                    </div>
                    <button type="submit" class="btn btn-success px-5">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
