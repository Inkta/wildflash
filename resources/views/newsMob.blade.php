@extends('app')
@section('content')
<div class="container">
    <div id="token" style="display:none;" token="{{csrf_token()}}"></div>
    @if(isset($fotos))
    @foreach($fotos as $foto)
    <div class="row" style='margin-bottom: 20px;'>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-xs-3">
                        <img class="img-circle" src="{{url($foto->user->fotografiaPerfil)}}" width="25" height="25"/>
                    </div>
                    <div class="col-xs-3">
                        <a href="{{url('usuari/profile/'.$foto->user->name)}}"><strong>{{$foto->user->name}}</strong></a>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-xs-10">
                <img class="bigImage" src="{{url($foto->path)}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-10">
                <span><a href="{{url('usuari/profile/'.$foto->user->name)}}">{{$foto->user->name}}</a></span><span>: {{$foto->nom}}</span>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <p><span>Likes: </span>{{$foto->puntuacio}}</p>
            </div>

        </div>
        <div class="row">

            <div class="col-xs-12">
                @if(in_array($foto->id,$likes))
                <button style="width:49%;" class="btn btn-warning"><a href="{{url('like/'.$foto->id)}}"><span class='glyphicon glyphicon-thumbs-down'></span> </a></button>
                @else
                <button style="width:49%;" class="btn btn-success"><a href="{{url('like/'.$foto->id)}}"><span class='glyphicon glyphicon-thumbs-up'></span> </a></button>
                @endif


                <button style="width:49%;" id="{{$foto->id}}"class="btn btn-success" onclick="Comments(this)"><span class='glyphicon glyphicon-comment'></span></button>
            </div>



        </div>
    </div>
    <hr/>
    @endforeach
    <?php echo $fotos->render(); ?>
    <div class="row" id="footer" style="position:fixed;bottom:0px;left:0px;">
        <div class="col-xs-12" >
            <form action="{{url('imatge')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
                <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="enviar" type="hidden" value="upload">
                <input type="file" onclick="clickSubmit()" name="image" capture="camera" accept="image/*"/>
            </form> 
        </div>
    </div>
    @endif
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        var w = $(window).width();
        $('.bigImage').attr('width', w);
        $('.bigImage').attr('height', w);
    });
</script>
<script src="js/ComentariMob.js"></script>
@stop
@endsection