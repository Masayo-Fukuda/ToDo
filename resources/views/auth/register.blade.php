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

</body>
    <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body-1">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-body-2">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-body-2-1">
                    <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                    <div class="col-md-6">
                        <input id="avatar" type="file" class="@error('avatar') is-invalid @enderror" name="avatar">

                        @error('avatar')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-body-2">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="card-body-2">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="card-body-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                </div>
            </form>
        </div>
    </div>