@extends('app')

@section('content')
<div class="container">
    @if (isset($fotografia))
    <p> {{$fotografia->nom}} </p>
    <img src="{{$fotografia->path}}" style="max-width: 1000px"/>
    <div class="row">
        <div class="col-xs-12">
            <a href="like"><img src="http://www.adweek.com/socialtimes/files/2013/12/LikeStickersSparkle.jpg" height="18" width="36"/></a>
        </div>
    </div>
    
    <p>Autor: <a href="usuari/profile/{{$Autor}}">{{$Autor}}</a></p>
    

    @for ($i = 0; $i < count($comentaris); $i++)
    <div class="row">
        <div class="col-xs-2">
            <a href="perfil/{{$comentaristes[$i]->name}}"><p>{{$comentaristes[$i]->name}}</p></a>
        </div>
        <div class="col-xs-9">
            <p>{{$comentaris[$i]->comentari}}</p>
        </div>
        <div class="col-xs-1">
            {{$comentaris[$i]->puntuacio}}
            <a href="like"><img src="http://www.adweek.com/socialtimes/files/2013/12/LikeStickersSparkle.jpg" height="18" width="36"/></a>
        </div>
    </div>
        
    
    
        @endfor
    
    @endif
    
</div>
@endsection
