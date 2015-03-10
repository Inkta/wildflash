@extends('app')
@section('css')
<link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" charset="utf-8"/>
@stop
@section('content')
<div class="container">
    <div class="row">
        <h2 class="subheader">Amics</h2>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Imatge</th>
                    <th>Nom</th>
                    <!--<th>Email</th>-->
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach (Auth::user()->friends as $friend)
                <tr style="border:1px solid #d8d8d8;border-radius:10px;">
                    <td><img src="{{url($friend->fotografiaPerfil)}}" class="img-circle" width="40px" height="40px"></img></td>
                    <td>{{ $friend->name }}</td>
                    <!--<td>{{ $friend->email }}</td>-->
            <form action="{{url('dashboard/remove-friend/'. $friend->id)}}">
                <td><button class="btn btn-danger">Remove friend <span class="glyphicon glyphicon-remove-circle"></span></button></td>
            </form>

            </tr>
            @endforeach
            </tbody>
        </table>

        <h2 class="subheader">Més gent</h2>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Imatge</th>
                    <th>Nom</th>
                    <!--<th>Email</th>-->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($not_friends as $friend)
                <tr style="border:1px solid #d8d8d8;border-radius:10px;">
                    <td><img src="{{url($friend->fotografiaPerfil)}}" class="img-circle" width="40px" height="40px"></img></td>
                    <td>{{ $friend->name }}</td>
                    <!--<td>{{ $friend->email }}</td>-->
            <form action="{{url('dashboard/add-friend/'. $friend->id)}}">
                <td><button class="btn btn-primary">Add friend <span class="glyphicon glyphicon-ok"></span></button></td>
            </form>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if (isset($mobil) && $mobil == false)

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



@endsection
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
<script>
    function readURL(input) {
        var reader = new FileReader();
        if (input.id == 'cameraPerfil') {
            if (input.files && input.files[0]) {
                reader.onload = function (e) {
                    $('#fotografiaPerfil').attr('src', e.target.result);
                    $('#butoPerfil').attr('style', 'display:none;');
                    $('#submitPerfil').removeAttr('style');
                    $('#submitPerfil').attr('style','margin-bottom:5px;');
                    $('#backPerfil').removeAttr('style');
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
@stop
@endsection