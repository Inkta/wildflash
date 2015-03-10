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
                
                <button style="width:49%;" class="btn btn-danger"><a style="color:white;" href="{{url('like/'.$foto->id)}}"><span class='glyphicon glyphicon-thumbs-down'></span> </a></button>
                @else
                <button style="width:49%;" class="btn btn-primary"><a style="color:white;" href="{{url('like/'.$foto->id)}}"><span class='glyphicon glyphicon-thumbs-up'></span> </a></button>
                @endif


                <button style="width:49%;" id="{{$foto->id}}"class="btn btn-primary" onclick="Comments(this)"><span class='glyphicon glyphicon-comment'></span></button>
            </div>



        </div>
    </div>
    <hr/>
    @endforeach
    <?php echo $fotos->render(); ?>
    <div class="row" id="footer" style="position:fixed;bottom:0px;left:0px;">
        <div class="col-xs-4" style="padding-right:0px; padding-left:0px;height:40px;">
            <form action="{{url('usuari/profile/'. Auth::user()->name)}}">
                <button style="width:100%;height:100%;background-color:#000066;border:1px solid black;" class="btn btn-primary"><img src='{{url('imgApp/user-1.png')}}' width='20' height="20"/></button>
            </form>

        </div>
        <div class="col-xs-4" style="padding-right:0px; padding-left:0px;height:40px;">
            <form style="height:40px;" action="{{url('uploadImage')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="enviar" type="hidden" value="upload">

                <button style="width:100%;height:100%;background-color:#000066;border:1px solid black;" class="btn btn-primary uploadMob">
                    <span class="glyphicon glyphicon-camera"></span>
                    <input id="cameraAlbum" type="file" name="image" capture="camera" accept="image/*"/>
                </button>            
            </form> 
        </div>
        <div class="col-xs-4" style="padding-right:0px; padding-left:0px;height:40px;">
            <form action="{{url('dashboard')}}">
                <button style="width:100%;height:100%;background-color:#000066;border:1px solid black;" class="btn btn-primary"><img src='{{url('imgApp/friends-1.png')}}' width='20' height="20"/></button>
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
<script>
    function readURL(input) {
        var reader = new FileReader();
        if (input.id == 'cameraPerfil') {
            if (input.files && input.files[0]) {
                reader.onload = function (e) {
                    $('#fotografiaPerfil').attr('src', e.target.result);
                    $('#butoPerfil').attr('style', 'display:none;');
                    $('#submitPerfil').removeAttr('style');
                }
            }
        } else if (input.id == 'cameraAlbum') {
            $('#formulariImatge').submit();

        }
        reader.readAsDataURL(input.files[0]);
    }




    $("input[type=file]").change(function () {
        readURL(this);
    });
</script>
<script src="js/ComentariMob.js"></script>
@stop
@endsection