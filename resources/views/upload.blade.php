@extends('app')
@section('content')
<?php $i = 0; ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <img src="{{url("img/".Auth::user()->name."/temporals/".$path)}}" width="300" height="300"/>
        </div>
    </div>
    <div class="row">
        <form action="{{url('imatge')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input  type="hidden" name="path" value="{{$path}}">
            <div class="row">
                <div class="col-xs-10">
                    <input style="margin:10px 0 10px 0;margin-left:5%;"type="text" name="fname" placeholder="Titol de la imatge">
                </div>
            </div>
            <button id="envia" class="btn btn-primary col-md-8 col-xs-offset-2 col-xs-8" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
            
        </form> 
        <form action="{{url('cancelar')}}" method="POST" enctype="multipart/form-data">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input  type="hidden" name="path" value="{{$path}}">
            <button id="borra" class="btn btn-danger col-md-8 col-xs-offset-2 col-xs-8" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
        </form>
    </div>
    

</div>

@section('scripts')
<script>
    $("#formulariImatge").submit(function (e) {
        if ($('#latitud').length == 0) {
            e.preventDefault();
            $('#borra').remove();
            $('#envia').remove();
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