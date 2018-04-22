<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fix4all - Klusbedrijf | Login</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Include Editor style. -->
    <link href='{{ asset('css/summernote.css') }}' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="{{ route('home') }}"><img src="{{ asset('img/LogoBlack@0,5x.png') }}" alt="Fix4all logo" style="margin-top: 10px;"></a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li style="margin-top: 20px;"><a href="{{ route('login') }}">Login</a></li>
                            <li style="margin-top: 20px;"><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown" style="margin-top: 20px;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @auth
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Wat wilt u bewerken?</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="{{ route('user_meta') }}">Meta Data</a></li>
                                <li><a href="{{ route('user_home') }}">Intro</a></li>
                                <li><a href="{{ route('user_opdrachten') }}">Recente Opdrachten</a></li>
                                <li><a href="{{ route('user_about') }}">Over Fix4all</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endauth

        </div>
        @yield('content')
    </div>
    <div style="position: relative;right: 0;bottom: 0;left: 0;padding: 1rem;text-align: center;">
        <div>
            <p style="color: #c4c4c4; font-size: 12px; margin-bottom: 0;">Created and Designed by</p>
            <a href="http://mazeyar.nl"><img src="http://mazeyar.nl/images/logo.png" alt="Mazeyar Rezaei Ghavamabadi"></a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include JS file. -->
    <script type='text/javascript' src='{{ asset('js/summernote.min.js') }}'></script>
    <script src="{{ asset('js/summernote-nl-NL.min.js') }}"></script>
    @if (!App::isLocal())
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-96990724-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-96990724-3');
        </script>

    @endif

    @yield('script')
</body>
</html>
