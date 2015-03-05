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
            @if(isset($perfil)&&($usuariProfile))
            @foreach($usuariProfile->fotografies as $fotografies)
            <img src="{{url($fotografies->path)}}" width="500" height="350"/>
            @endforeach
            @endif
        </div>
    </div>


    @section('menu')
    <div class='row' id="menu_footer">
        @if (isset($mobil) && $mobil == true)
        <div class="row">
            <div class="col-xs-12" >
                <form action="{{url('imatge')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="enviar" type="hidden" value="upload">
                    <input type="file" onclick="clickSubmit()" name="image" capture="camera" accept="image/*"/>
                </form> 
            </div>
        </div>
        @endif

    </div>
    @show



</div>
@section('scripts')
<script src="/wildflash/public/js/Submit.js"></script>
<script src="/wildflash/public/js/Marker.js"></script>

@stop
@endsection
