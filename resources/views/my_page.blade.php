<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
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
    <p>My Page</p>
  </div>

  <div class="task">
    <h1>Your Tasks</h1>
    @foreach($tasks as $task)
    <div class="tasks">
      <h3>Title:{{ $task->title }}</h3>
      <p>Content:{{ $task->contents }}</p>
      <form action="{{ route('tasks.destroy', [$task->id]) }}" method="post">
        @csrf
        <input type="submit" value="Delete">
      </form>
      <a href="{{ route('tasks.edit', $task) }}">Edit</a>
      <a href="{{ route('tasks.comments.index', $task->id) }}">View Comments</a>
    </div>
    @endforeach

    <h1>Your Bookmerks</h1>
    @foreach ($bookmarks as $bookmark)
      <div class="tasks">
        <div>{{ $task->user->name }}'s task</div>
        <h3>Title：{{ $bookmark->task->title }}</h3>
        <p>Content：{{ $bookmark->task->contents }}</p>
      </div>
    @endforeach
  </div>
  
</body>
</html>