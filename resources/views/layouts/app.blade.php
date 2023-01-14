
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/js/app.js','resources/css/app.css'])
{{--    'resources/sass/app.scss',     --}}



</head>
<body>
<div id="app">


    <div class="container">
        <div class="navbar">
            <div class="logo">
{{--                <img src="public/imgs/logo.png" width="125" alt="">--}}
            </div>
            <a class="navbar_link" href="{{ route('game') }}">Game</a>
            <a class="navbar_link" href="{{route('home')}}">Home</a>
            <a class="navbar_link" href="{{route('calender')}}">Calendar</a>
            <a class="navbar_link" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Shop
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                <a class="dropdown-item" href="{{ route('shopView') }}" >
                    {{ __('Shop') }}
                </a>
                <a class="dropdown-item" href="{{ route('addProdView') }}" >
                    {{ __('Add Product') }}
                </a>
                <a class="dropdown-item" href="{{ route('productShow') }}" >
                    {{ __('Spravuj Product') }}
                </a>
                <a class="dropdown-item" href="{{ route('cartView') }}" >
                    {{ __('Cart') }}
                </a>
            </div>
            <a class="navbar_link" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Kontakt
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                <a class="dropdown-item" href="{{ route('contactForm') }}" >
                    {{ __('Kontakt') }}
                </a>
                <a class="dropdown-item" href="{{ route('contactShow') }}" >
                    {{ __('All contacts') }}
                </a>
            </div>

                <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))

                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

                @if (Route::has('register'))

                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                @endif
            @else
                <a class="navbar_link" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    {{--        edit profile                    --}}
                    <a class="dropdown-item" href="{{ route('editProfile') }}" >
                        {{ __('Edit Profile') }}
                    </a>

                    {{-- end of edit profile --}}


{{--                    delete profile                    --}}
                    <a class="dropdown-item" href="{{ route('deleteProfilenav') }}" >
                        {{ __('Delete account') }}
                        </a>

                    {{-- end of delete profile --}}

                    <a  class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                    @endguest
                </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
