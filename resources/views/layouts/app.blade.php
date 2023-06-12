<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand bg-transparent border-0" href="{{ url('/') }}">
                   RSBINTARO PREMIER 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a href="/riwayat" class="dropdown-item">History</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

            <main class="container">
                {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> --}}
                    @yield('content')
                {{-- </div> --}}
            </main>
        <main class="py-0">
            <footer>
                <div class="container">
                    <div class="row g-5">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="section-logo-footer">
                                <img src="{{url('images/logo-footer-hospital.svg')}}" class="img-fluid" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="section-alamat-hospital">
                                <span>RS Premier Bintaro</span> <br>
                                <span>Jl. MH Thamrin No. 1, Sektor 7 Bintaro Jaya, Kota Tangerang Selatan, 15224</span> 
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="section-contact-footer">
                                <span>RS Premier Bintaro</span><br>
                                <span>RSDHealth Careline:<a href="http://tel:1500908"> 1 500 908</a></span><br>
                                <span>WA Appointment:<a href="https://api.whatsapp.com/send/?phone=6281222309911&text&type=phone_number&app_absent=0"> +62 8122 2309 911</a></span><br>
                                <span>IGD & Ambulans: +6221 7458 118</span>
                                <span>WA IGD & Ambulans: +62811 9690 5513</span>
                            </div>
                        </div>
                    </div>
                    <hr style="border: 2px solid #fff">
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="section-footer-bottom" style="justify-content: space-evenly; display: block">
                            <div class="sosmed-footer">
                                <a href="https://www.instagram.com/rspremierbintaro/"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.facebook.com/RSPremierBintaro/"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.youtube.com/c/PremierBintaroHospital"><i class="bi bi-youtube"></i></a>
                                <a href="https://www.google.com/maps/place/Premier+Bintaro+Hospital/@-6.2761985,106.721535,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69fa9d8b042767:0x2a7956b6a6d3c3c3!8m2!3d-6.2761985!4d106.7237237"><i class="bi bi-geo-alt-fill"></i></a>
                            </div>
                            <div class="section-copyright">
                                <span>&copy; 2021 Ramsay Sime Darby Health Care - Hak Cipta Dilindungi</span>
                            </div>
                            </div>               
                        </div>
                    </div>
                </div>
            </footer>
            @yield('footer')
        </main>
    </div>

    <script src="assets/js/dashboard.js"></script>
</body>
</html>
