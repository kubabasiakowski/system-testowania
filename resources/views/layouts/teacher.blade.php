<!DOCTYPE html>
<html lang="en">
<head>
  <title>SAT.edu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">SAT.edu</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="{{ '/' }}">Strona główna</a></li>
        <li><a href="{{ '/yourTests' }}">Stworzone testy</a></li>
        <li><a href="{{ '/activeTests' }}">Aktywne testy</a></li>
        <li><a href="{{ '/scores' }}">Wyniki studentów</a></li>
        <li><a href="{{ '/createTest' }}">Nowy test</a></li>
        <li><a href="{{ '/questions' }}">Dodaj pytanie</a></li>
        <li><a href="{{ '/allQuestions' }}">Wszystkie pytania</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li><a href="/teacher"><span class="glyphicon glyphicon-cog"></span> {{Auth::user()->name}}</a></li>
          <li>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>
        @else
          <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
          <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Zarejestruj</a></li>
        @endif
      </ul>
    </div>
  </nav>

<div class="container">
  @yield('pageContent')
</div>

</body>
</html>