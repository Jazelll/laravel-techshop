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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                    Welcome {{Auth::user()->role }}, {{ ucfirst(Auth::user()->name) }}!
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    {{-- ADMIN DROPDOWN ->> GO TO HOME/DASHBOARD, LOGOUT --}}
                                    {{-- Admin can view, create, and manage all the products uploaded by o. --}}

                                    @if (Auth::user()->role == 'admin')
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('dash-form').submit();">
                                            {{ __('Go to Dashboard') }}
                                        </a>

                                        <form id="dash-form" action="{{ route('admin.dashboard') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ route('user.home') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('home-form').submit();">
                                            {{ __('Go to Home') }}
                                        </a>

                                        <form id="home-form" action="{{ route('user.home') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                    {{-- MERCHANT DROPDOWN --}}
                                    {{-- Merchant, who is also a user, can view, create, and manage product but can only manage the products he uploaded.--}}

                                    {{-- @elseif (Auth::user()->role == 'merchant')
                                        <a class="dropdown-item" href="{{ route('user.home') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('home-form').submit();">
                                            {{ __('Go to Home') }}
                                        </a>

                                        <form id="home-form" action="{{ route('user.home') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ route('create') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('create-form').submit();">
                                            {{ __('Create Product') }}
                                        </a>

                                        <form id="create-form" action="{{ route('create') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ route('manage') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('manage-form').submit();">
                                            {{ __('Manage Product') }}
                                        </a>

                                        <form id="manage-form" action="{{ route('manage') }}" method="POST" class="d-none">
                                            @csrf
                                        </form> --}}
                                    
                                    {{-- USER DROPDOWN ->> LOGOUT --}}
                                    {{-- User can only see the products, add to cart, and checkout, he cannot manage nor create products. --}}

                                    {{-- @else 
                                        
                                        <a class="dropdown-item" href="{{ route('user.home') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('home-form').submit();">
                                            {{ __('Go to Home') }}
                                        </a>

                                        <form id="home-form" action="{{ route('user.home') }}" method="POST" class="d-none">
                                            @csrf
                                        </form> --}}

                                    @endif

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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<style>
        .table.table-hover th {
            background-color: #4967b9;
            pointer-events: none;
            border-collapse: collapse;
        }
        .btn.btn-primary a{
            text-decoration: none;
            color: black;
        }
        .no-wrap{
            white-space: nowrap;
        }
        a {
            text-decoration: none;
            color: black;
        }
        

        .category-container {
            display:inline-block;
            border-radius: 5px;
        }

        .monitor {
            background-color: rgb(159, 204, 232);
        }

        .accessories {
            background-color: #D2E1C8;
        }

        .mouse {
            background-color: rgb(234, 232, 216);
        }

        .keyboard {
            background-color: rgb(1, 102, 128);
        }

        span.tag {
            text-align: center;
            border-radius: 1rem;
            font-size: 11px;
            font-weight: 900;
            padding: 4px 8px;
            text-transform: uppercase;
            display: inline-block;
            width: auto;
        }


</style>

</html>

