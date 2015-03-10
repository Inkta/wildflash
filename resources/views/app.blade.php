<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
        <title>Wildflash</title>

        <link href="{{url('/css/app.css')}} rel="stylesheet">
              <link href="{{url('/css/bootstrap.min.css')}}" rel="stylesheet">
        @yield('css')    
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link href="{{url('/css/login.css')}}" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    @yield('style')
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo-wildflash" href="{{url()}}"><img src="{{url('imgApp/logo-wildflash.png')}}"/></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <!-- <ul class="nav navbar-nav">
                         <li><a href="/">Home</a></li>
                     </ul>-->
                    <form class="navbar-form navbar-left" role="search" method="post" action="{{url('usuari')}}">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="form-control" type="text" name="profile" placeholder="Busca...">
                        </div>
                    </form>



                    <ul class="nav navbar-nav navbar-right menulinks">
                        @if (Auth::guest())
                        <li><a href="{{url('/auth/login')}}">Login</a></li>
                        <li><a href="{{url('/auth/register')}}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/auth/logout')}}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        @section('menulateral')
        @if(isset($mobil) && $mobil == true)
        <div>
            <ul id="navigation">
                <li class="home"><a href="{{url('home')}}" title="Home"></a></li>
                <li class="news"><a href="{{url('news')}}" title="News"></a></li>
                <li class="followers"><a href="{{url('dashboard')}}" title="Followers"></a></li>
            </ul>
        </div>
        @endif
        @show

        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        @yield('scripts')

    </body>
</html>
