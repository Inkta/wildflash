@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default col-md-offset-2 col-md-8 nopadding">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">

                            <div class="col-md-10 col-md-offset-1">
                                <input placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-10 col-md-offset-1">
                                <input placeholder="Password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Login</button>

                                <a class="btn btn-link" href="/password/email">Forgot Your Password?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">

                                <h4 style="color:white">BENVINGUTS A <span style="font-size:22px">WILDFLASH<span></h4><p style="color:white;text-align:justify;"> La nova xarxa social fotogràfica que permet compartir
                                                qualsevol lloc del món amb qui vulguis. Prepara't per guanyar-te un nom entre nosaltres.
                                                Sigues el millor fent fotografies.
                                            </p>
                                            </div>
                                            </div>
                                            </form>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <script type="text/javascript">

                                                var classes = ['primera', 'segona', 'tercera', 'quarta'];
                                                var i = 0;
                                                document.body.setAttribute("class", "quarta");
                                                setInterval(function () {

                                                    document.body.className = "" + classes[i] + "";

                                                    i++;
                                                    if (i == 4) {
                                                        i = 0;
                                                    }
                                                }, 8000);

                                            </script>
                                            @endsection