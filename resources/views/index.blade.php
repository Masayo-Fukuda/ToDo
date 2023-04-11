<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
    <p>All Tasks</p>
  </div>
  <div class="box">
    <a href="{{ route('tasks.create') }}">Create Task</a>
  </div>
  <div class="task">
    
      @foreach ($tasks as $task)
        <ul class="tasks">
          <div class="box">
            <img id="avatar" src="{{ asset('storage/images/'. $task->user->avatar) }}" width="100px" alt="">
            <div>{{ $task->user->name }}'s task</div>
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
        </ul>
      @endforeach
      {{ $tasks->links() }}
  </div>
</body>
</html>