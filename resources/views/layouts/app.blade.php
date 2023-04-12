<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <div class="left">
                <a href="{{ url('tasks') }}">
                    ToDo
                </a>
            </div>
            <div class="right">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
        
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a>{{ Auth::user()->name }}'s Page</a>
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                @endguest
            </div>
          </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
