<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/header.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
    <p>All Tasks</p>
  </div>
  <div class="button">
    <a href="{{ route('tasks.create') }}">Create Task</a>
  </div>

      @foreach ($tasks as $task)
      <div class="task">
        <div class="box-1">
          <img id="avatar" src="{{ asset('storage/images/'. $task->user->avatar) }}" alt="">
          <h2>{{ $task->user->name }}'s task</h2>
        </div>

        <h1>{{ $task->title }}</h1>
        <p>{{ $task->contents }}</p>

        <div class="box">
          @if (Auth::check() && $task->user_id === Auth::id() )
            <button type="button" onclick="location.href='{{ route('tasks.edit', $task) }}'">Edit</button>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
              @csrf
              <input type="submit" value="Delete" onclick="return confirm('Do you really want to delete this?');">
          </form>
          @endif
        </div>

        <div class="box">
          <button type="button" onclick="location.href='{{ route('tasks.comments.create', $task->id) }}'">Add a Comment</button>
          <button type="button" onclick="location.href='{{ route('tasks.comments.index', $task->id) }}'">View Comments</button>

          @if ($task->bookmarkedBy(auth()->user()))
          <form action="{{ route('bookmark.destroy', $task->bookmarkByUser(auth()->user())) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete from Bookmarks</button>
            <i type="submit" class="fa-sharp fa-solid fa-bookmark"></i>
          </form>
          @else
          <form action="{{ route('bookmark.store') }}" method="POST">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <button type="submit">Add to Bookmarks</button>
          </form>
          @endif
        </div>
      </div>


      @endforeach
      {{ $tasks->links() }}
  </div>
</body>
</html>