<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
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

    <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="card-body-1">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-body-2">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="check">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-body-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
                <div class="link">
                    @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>

            </form>
        </div>
    </div>
</body>

</html>
