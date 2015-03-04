@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-3">
            <div class="row">
                <div class="col-xs-10 col-offset-xs-2 ">
                    @if(isset($perfil))
                    <img class="img-circle" src="{{url($perfil->fotografiaPerfil)}}" width="80px" height="80px"/>
                    @else
                    <img class="img-circle" src="{{url(Session::get('usuari')->fotografiaPerfil)}}" width="80px" height="80px"/>
                    @endif
                </div>
            </div>
            <div class="row">
                @if(isset($perfil) && $perfil->id != $usuariProfile->id)
                <div class="col-xs-12"><h2 class="text-center">{{ $perfil->name }}</h2></div>
                <div class="col-xs-12"><h3 class="text-center">{{$perfil->rang}}</h3></div>
                <a href="{{url('dashboard/add-friend/'. $perfil->id)}}">Follow</a>
                <a href="{{url('dashboard/remove-friend/'. $perfil->id)}}">Dejar de seguir</a>

                @else   
                <div class="col-xs-12"><h2 class="text-center">{{ Session::get('usuari')->name }}</h2></div>
                <div class="col-xs-12"><h3 class="text-center">{{Session::get('usuari')->rang}}</h3></div> 

                @endif
                <div class="col-xs-12">
                    @if(isset($perfil) && $perfil->id == $usuariProfile->id)  
                    <form action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="imatge"/>
                        <input type="submit" value="Upload"/>
                    </form>
                    <a href="{{url('dashboard')}}">Followers</a>
                    @elseif(!isset($perfil))
                    <form action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="imatge"/>
                        <input type="submit" value="Upload"/>
                    </form> 
                    @endif 
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9 ">
            <div id="map_canvas" class="col-xs-12" style="height:400px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="fotos col-xs-12">
            @foreach($fotografies as $foto)
            <p> {{$foto->latitud}}</p>
            @endforeach
        </div>
    </div>


    @section('menu')
    <div class='row' id="menu_footer">
        @if (isset($mobil) && $mobil == true)
        <div class="row">
            <div class="col-xs-12">
                <form action="{{url('imatge')}}" method="POST" enctype="multipart/form-data" id="formulariImatge">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="file" onclick="clickSubmit()" name="image" capture="camera" accept="image/*"/>
                    <input type="submit" value="Upload"/>
                </form> 
            </div>
        </div>
        @endif
    </div>
    @show
    <script>

        function clickSubmit() {
            //controlar el submit de les imatges, afegir els 2 camps latitud i longitud quan es fa una foto
            var lat;
            var long;
            if (!!navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    lat = position.coords.latitude;
                    long = position.coords.longitude;


                    $('<input />').attr('type', 'hidden')
                            .attr('name', "latitud")
                            .val(lat)
                            .appendTo('#formulariImatge');

                    $('<input />').attr('type', 'hidden')
                            .attr('name', "longitud")
                            .val(long)
                            .appendTo('#formulariImatge');
                });
            } else {
                alert("No geo");
            }
        }

    </script>


</div>
@endsection
