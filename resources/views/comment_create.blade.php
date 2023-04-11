<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/create.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('tasks') }}">
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
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('my_page.show', Auth::user()->id) }}">{{ __('My Page') }}</a>
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

  <div class="title">
    <p>Add a comment</p>
  </div>

  <div class="comment_box">
    <div class="content">
      <h1>Title: {{ $tasks->title }}</h1>
      <p>User:{{ $tasks->user->name }}</p>
      <p>Content:{{ $tasks->contents }}</p>
    </div>

    <div class="content">
      <form action="{{ route('tasks.comments.store', '$task->id') }}" method="post">
        @csrf
        <input type="hidden" name="task_id" value="{{ $tasks->id }}">
        <textarea name="body" cols="50" rows="3" placeholder="Content"></textarea>
        @if ($errors->has('body'))
          <p id="error">ERROR!{{$errors->first('body')}}</p>
        @endif
        <br>
        <button type="submit">Add a Comment</button>
      </form>
    </div>
  </div>
</body>
</html>