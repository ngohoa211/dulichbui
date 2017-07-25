<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> 
    <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dulichbui</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                   <!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar">Home</span>
                        <span class="icon-bar">All trip</span>
                        <span class="icon-bar">User page</span>
                    </button>
 -->
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">Dulichbui </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
<div class="header-bottom"  style="background-color:#000000;">
            <div class="container">
                <nav class="main-menu">
                    <ul class="l-inline ov">
                    @if(Auth::check())
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li> <a href="{{route('alltrip')}}">All trip</a></li>
                        <li><a>User page</a>
                           <ul class="sub-menu">
                                <li><a href="{{route('profile')}}">Profile</a></li>
                                <li><a href="#">List of trips join</a></li>
                                <li><a href="#">List of trips follow</a></li>
                                <li><a href="#">List of trips create by me</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('alltrip')}}">All trip</a></li>
                    @endif
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> <!-- .container -->
        </div> <!-- .header-bottom -->
        @yield('content')
    </div>
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
