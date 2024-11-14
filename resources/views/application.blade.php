<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{asset('front/css/homepage.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/productpage.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/shopingcart.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/searchresult.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-1">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Xstore
                </a>
                <!-- search button -->
                <div>
                    <form class="d-flex align-items-center border-bottom" role="search" action="{{ route('search.view')}}" method="get">
                        @csrf
                        <input class="form-control me-2 searchinput" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="border-0 bg-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <!-- end search -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav me-auto">

                    </ul> -->

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

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li>
                                <a href="{{route('over')}}" class="nav-link" href="#" role="button">
                                    Dashboard
                                </a>
                            </li>

                            <li>
                                <a href="{{route('view.cart')}}" class="nav-link" href="#" role="button">
                                    Cart
                                </a>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
                <!-- Categories bar -->
            <ul class="nav justify-content-center border">
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'elect')}}">Electronics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'book')}}">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'clothe')}}">Clothing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'kitchen')}}">Kitchen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'beauty')}}">Beauty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'game')}}">Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'car')}}">Automotive</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'sport')}}">Sports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'health')}}">Health</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link categories" href="{{route('filter.view', 'tool')}}">Tools</a>
                </li>
            </ul>
            <!-- end Categories bar -->
            <!-- end Categories bar -->
        @endauth

        <main class="pb-4">
            @yield('content')
        </main>

    </div>
</body>
<!-- Bootstrap 5.3.3 -->
<script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
<!-- font awesome icons -->
<script src="{{asset('front/js/all.min.js')}}"></script>
<script src="{{asset('front/js/aos.js')}}"></script>
<!-- JQuery -->
<script src="{{asset('front/js/jquery.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('front/js/custom.js')}}"></script>

<script>
    $(document).ready(function (){
        $('.sub-photo img').click(function (){
            $('.main-photo img').attr('src',$(this).attr('src'));
        });
    });
</script>
<script>
    $(document).ready(function() {
    var container = $(".zoom");
    var img = container.find("img");

    container.mousemove(function(event) {
        var offset = container.offset();
        var x = event.pageX - offset.left;
        var y = event.pageY - offset.top;
        var width = img.width();
        var height = img.height();
        var scale = 2; // The zoom level


        // Calculate the new top and left positions of the image
        var newLeft = -(x - container.width() / 2) * (scale - 1);
        var newTop = -(y - container.height() / 2) * (scale - 1);


        // Apply the new positions to the image
        img.css({
            transform: "translate(" + newLeft + "px," + newTop + "px) scale(" + scale + ")"
        });
    });

    container.mouseout(function() {
        // Reset the image to its default state
        img.css({
            transform: "scale(1)"
        });
    });
});
</script>
</html>
