<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="content">
        <p>Manege your tasks!</p>
        @if (Route::has('login'))
        <div>
            @auth
                <a href="{{ url('/tasks') }}" class="left-btn">timeline</a>
                <a class="dropdown-item right-btn" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
            @else
                <a href="{{ route('login') }}" class="left-btn">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="right-btn">Register</a>
                @endif
            @endauth
        </div>
        @endif
    </div>
</body>
</html>