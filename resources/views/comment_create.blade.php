<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/create.css') }}">
  <link href="{{ asset('css/header.css') }}" rel="stylesheet">
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
            <a href="{{ route('my_page.show', Auth::user()->id ) }}">{{ Auth::user()->name }}'s Page</a>
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