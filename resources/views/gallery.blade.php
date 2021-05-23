@extends('layouts.user')
@section('title', 'PT.Karya Buah Tropis - Galeri')
@section('head')
<style>
    .greenh {
        color: #000000;
    }

    .greenh:hover {
        color: #28a745;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.6.2/viewer.min.js"
    integrity="sha512-VzJLwaOOYyQemqxRypvwosaCDSQzOGqmBFRrKuoOv7rF2DZPlTaamK1zadh7i2FRmmpdUPAE/VBkCwq2HKPSEQ=="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.6.2/viewer.min.css"
    integrity="sha512-8ZhoOdKiZafVRcEa08KcidOK/B85ByNOaWUiBXRi8kZ3pWUWJsBuY8sGBK6hZPWZhH35uXtFyRH/5DLTo2u6EQ=="
    crossorigin="anonymous" />
@endsection
@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-12">
            <h1>Galeri</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Perolehan Buah Beku</h3>
        </div>
    </div>
    <ul id="images" class="row">
        @foreach($pbb as $pb)
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-4">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$pb->url}}" allowfullscreen></iframe>
            </div>
        </div>
        @endforeach
    </ul>
    @if(count($pbb) == 0)
    <div class="alert alert-secondary" role="alert">
        Galeri Perolehan Buah Beku sedang tidak tersedia.
    </div>
    @else
    <div class="d-flex justify-content-end">
        {{ $pbb->links("pagination::bootstrap-4") }}
    </div>
    @endif
    <div class="row mt-3">
        <div class="col-12">
            <h3>Packing & Order</h3>
        </div>
    </div>
    <ul id="images" class="row">
        @foreach($po as $p)
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-4">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$p->url}}" allowfullscreen></iframe>
            </div>
        </div>
        @endforeach
    </ul>
    @if(count($po) == 0)
    <div class="alert alert-secondary" role="alert">
        Galeri Packing & Order sedang tidak tersedia.
    </div>
    @endif
</div>
</div>
@endsection
@section('script')
<script>
    // View a list of images
const gallery = new Viewer(document.getElementById('images'));
// Then, show one image by click it, or call `gallery.show()`.
</script>
@endsection
