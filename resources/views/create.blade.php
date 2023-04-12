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
    <p>Create</p>
  </div>

  <div class="box">
    <form action="{{ route('tasks.store') }}" method="POST" >
      @csrf
      <div class="content">
        <label>Title （less than 30 characters）</label>
        <input type="text" class="" placeholder="Title" name="title">
        @if ($errors->has('title'))
          <p>ERROR!{{$errors->first('title')}}</p>
        @endif
      </div>
  
      <div class="content">
        <label>Content （less than 140 characters）</label>
        <textarea placeholder="Content" rows="5" name="contents"></textarea>
        @if ($errors->has('contents'))
          <p>ERROR!{{$errors->first('contents')}}</p>
        @endif
      </div>
      
        <button type="submit" class="">Create</button>
  
      <a href="{{ url()->previous() }}">Back</a>
    </form>
  </div>

</body>
</html>
