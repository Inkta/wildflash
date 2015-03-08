@extends('app')
@section('content')
<?php $i = 0; ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <img src="{{url("img/".Session::get('usuari')->name."/temporals/".$path)}}" width="300" height="300"/>
        </div>
    </div>
    <div class="row">
        <form action="{{url('imatge')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input  type="hidden" name="path" value="{{$path}}">
            <div class="row">
                <div class="col-xs-10">
                    <span>Titol de la Imatge: </span><textarea name="titol" cols="20" rows="1"></textarea> 
                </div>
            </div>
            <input id="enviar" type="submit" value="upload">
            
        </form> 
        <form action="{{url('cancelar')}}" method="POST" enctype="multipart/form-data">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input  type="hidden" name="path" value="{{$path}}">
            <input id="enviar" type="submit" value="Cancelar">
        </form>
    </div>

</div>

@section('scripts')
<script>
    $("#formulariImatge").submit(function (e) {
        if ($('#latitud').length == 0) {
            e.preventDefault();
            $('#formulariImatge').append('<p> Calculando Posicion...</p>');
            var lat;
            var long;
            function success(position) {
                lat = position.coords.latitude;
                long = position.coords.longitude;
                crearInputs(lat, long);
                $("#formulariImatge").submit();
            }

            function error() {
                lat = 0;
                long = 0;
                crearInputs(lat, long);
                $("#formulariImatge").submit();
            }

            var options = {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 9000
            };

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error, options);
            } else {
                alert("No geolocation available in your Web Browser");
            }
        } 
    });

    function crearInputs(lat, long) {
        $('<input />').attr('type', 'hidden')
                .attr('name', "latitud")
                .attr('id', "latitud")
                .val(lat)
                .appendTo('#formulariImatge');
        $('<input />').attr('type', 'hidden')
                .attr('name', "longitud")
                .val(long)
                .appendTo('#formulariImatge');

    }

</script>
@stop
@endsection