@extends('app')
@section('content')
<div class="container">
    @if(isset($foto)) 
    <div class="row">
        <div class="col-xs-5" id="imatge">
            <img class="img-circle" src="{{url($foto->path)}}"/> 
            <div class='row'>
                <div class='col-xs-5'><a href="{{url('comment/'.$foto->id)}}"><span class='glyphicon glyphicon-comment'></span></a></div>
                <div class='col-xs-5'><a href="{{url('like/'.$foto->id)}}"><span class='glyphicon glyphicon-thumbs-up'></span></a></div>
                <div class='col-xs-2'><div id="comollegar" lat="{{$foto->latitud}}" long="{{$foto->longitud}}"></div>

                </div>


                @foreach($foto->comentaris as $comentari)
                <a href="{{url('/usuari/profile/'.$comentari->user->name)}}">{{$comentari->user->name}}</a>
                <p>{{$comentari->comentari}}</p>
                @endforeach

            </div>
        </div>
        @endif

    </div>
    @section('scripts')
    <script src="/wildflash/public/js/Comollegar.js"></script>
    @stop
    @endsection