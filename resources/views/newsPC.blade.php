@extends('app')
@section('css')
<link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" charset="utf-8"/>

@stop

@section('style')
<style>

    @font-face{
        font-family: pacifico;
        src: url(fonts/OpenSans-SemiboldItalic.ttf);
    }
    .titol {
        font-family: pacifico;
        text-align: center;
        font-size: 20px;
    }

    #comment {
        padding:28px 3px 28px 3px;   
    }
    body{background-image:url('imgApp/wall3.jpg');}
    .container{background-color:white;padding-top:30px;}

</style>
@stop
@section('content')
<div class="container col-xs-offset-3 col-xs-6">
    <div>
        <ul id="navigation">
            <li class="home"><a href="{{url('home')}}" title="Home"></a></li>
            <li class="news"><a href="{{url('news')}}" title="News"></a></li>
            <li class="followers"><a href="{{url('dashboard')}}" title="Followers"></a></li>
        </ul>
    </div>
    @if(isset($fotos))
    @foreach($fotos as $foto)
    <div class="col-xs-offset-1 col-xs-10">
        <div class="row">
            <div class="row">
                <div class="col-xs-4">
                    <img src="{{url($foto->user->fotografiaPerfil)}}" class="img-circle" width="50px" height="50px" />

                    <a href="{{url('usuari/profile/'.$foto->user->name)}}">{{$foto->user->name}}</a>
                </div>


            </div>
            <span style="margin-left:20%;" class="titol">{{$foto->nom}}</span>
            <a href="{{url('usuari/profile/imatge/'.$foto->id)}}" ><img src="{{url($foto->path)}}" class="img-thumbnail" width="100%"/></a>
            <div class="row" style="margin-top:20px;">
                <div class="row">

                    <div class=" col-xs-2">
                        @if(in_array($foto->id,$likes))
                        <form action="{{url('like/'.$foto->id)}}">
                            <button style="width:100%;" class="btn btn-danger"><a href="{{url('like/'.$foto->id)}}" style="color:white;"><span class='glyphicon glyphicon-thumbs-down'></span> </a></button>
                        </form>
                        
                        @else
                        <form action="{{url('like/'.$foto->id)}}">
                            <button style="width:100%;" class="btn btn-primary"><a href="{{url('like/'.$foto->id)}}" style="color:white;"><span class='glyphicon glyphicon-thumbs-up'></span> </a></button>
                        </form>
                        
                        @endif
                    </div>
                    <div class="col-xs-4">
                        <p><span>M'agrada: </span>{{$foto->puntuacio}}</p>
                    </div>
                </div>
                <div class="boxComents" style="margin-top:20px;" class="col-xs-12">   

                    <form class="form-inline" action="{{url('comments/'.$foto->id)}}" method="POST">
                        <div class="form-group">
                            <input  type="hidden" name="_token" value="{{ csrf_token() }}">
                            <textarea  class="form-control" name="comentari" cols="47" rows="3"></textarea>
                            <button id="comment" class="btn btn-primary" type="submit">Comenta <span class="glyphicon glyphicon-comment"></span></button>
                        </div>
                    </form>


                    @if(count($foto->comentaris)>0)
                    <div id="mostraComentaris{{$foto->id}}">
                        <a style="cursor:pointer" id="{{$foto->id}}" onclick="mostraComentaris(this)"> Mostra Comentaris</a>
                    </div>
                    @else
                    <p>Ningú ha comentat aquesta foto, sigues el primer!</p>
                    @endif
                    <div id="commentsInv{{$foto->id}}" style="display:none;">
                        @foreach($foto->comentaris as $comentari)
                        <div class="comentari list-group-item">
                            <div class=""><p class="comentariuser"><img src="{{url($comentari->user->fotografiaPerfil)}}" class="img-circle" width="25px" height="25px"/><a class="comentariuserlink" href="{{url('usuari/profile/'.$comentari->user->name)}}"> 
                                        {{$comentari->user->name}}</a> - {{$comentari->comentari}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>

                </div>
            </div>
        </div>
    </div>
    @endforeach


    <?php echo $fotos->render(); ?>
    @endif



</div>

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#navigation a').stop().animate({'marginLeft': '-85px'}, 1000);

        $('#navigation > li').hover(
                function () {
                    $('a', $(this)).stop().animate({'marginLeft': '-2px'}, 200);
                },
                function () {
                    $('a', $(this)).stop().animate({'marginLeft': '-85px'}, 200);
                }
        );
    });
</script>
<script src="js/Comentaris.js"></script>
@stop
@endsection