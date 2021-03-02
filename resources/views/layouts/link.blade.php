<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gudang Buah Beku - Link Page</title>

    <!-- Bootstrap Script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
    </script>

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" />

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon" />

    <style>
        html {
            font-family: 'Titillium Web', sans-serif;
        }

        body {
            /* background-color: #28a745; */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center p-5">
                <img src="{{asset('img/favicon.png')}}" alt="" class="img-fluid" style="max-height: 200px;">
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-4">
                <a href="https://wa.me/6285105009300" class=" btn btn-success border" style="width: 85vw">
                    <h3><i class="fab fa-whatsapp"></i> Kontak Kami</h3>
                </a>
            </div>

            <div class="col-12 text-center mb-4">
                <a href="https://goo.gl/maps/BEh4CmpuWsdM6fiTA" class=" btn btn-light border" style="width: 85vw">
                    <h3>
                        <i class="fas fa-map-marker-alt">
                        </i> Lokasi Gudang
                    </h3>
                </a>
            </div>

            <div class="col-12 text-center mb-4">
                <a href="https://tokopedia.link/Kgu0GAvs1M" class=" btn btn-light border" style="width: 85vw">
                    <h3><span class="fab"><img src="{{asset('img/tokopedia.png')}}" width="20" height="20"
                                alt=""></span> Tokopedia
                    </h3>
                </a>
            </div>

            <div class="col-12 text-center mb-4">
                <a href="https://www.gudangbuahbeku.com" class=" btn btn-light border" style="width: 85vw">
                    <h3><i class="fas fa-globe"></i> Website
                    </h3>
                </a>
            </div>
        </div>
    </div>
    <div class=" copyright-bar fixed-bottom">
        <div class="container text-center text-light">
            Copyright @ 2020 Gudang Buah Beku. All rights reserved.
        </div>
    </div>
    </footer>

    @yield('script')
</body>

</html>
