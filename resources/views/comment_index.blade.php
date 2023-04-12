<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
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
    <p>All Comments</p>
  </div>

  <div class="task">
    @foreach($comments as $comment)
      <div class="tasks">
        <div>
          <p>User:{{ $comment->user->name }}</p>
          <p>Comment:<br>{{ $comment->body }}</p>
        </div>

        <div>
          @if (Auth::check() && $comment->user_id === Auth::id())
          <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
            @csrf
            <input type="submit" value="Delete" onclick="return confirm('Do you really want to delete this?');">
          </form>
        @endif
        </div>
      </div>
    @endforeach
    <a class="button" href="{{ route('tasks.index') }}">Back to Tasks List</a>
  </div>

</body>
</html>