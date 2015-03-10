@extends('app')
@section('css')
<link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" charset="utf-8"/>
<link href="{{url('/css/home.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row" style="margin-bottom:10px;">


        <div class="col-md-3 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    @if(isset($perfil))
                    <img id="fotografiaPerfil" class="img-circle" src="{{url($perfil->fotografiaPerfil)}}" width="80px" height="80px"/>
                    @else
                    <img class="img-circle" src="{{url(Session::get('usuari')->fotografiaPerfil)}}" width="80px" height="80px"/>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><h2 class="text-center">{{ $perfil->name }}</h2></div>       
                <div class="col-xs-12"><h3 class="text-center">{{$perfil->rang}}</h3></div>
                @if(isset($perfil) && $perfil->id != $usuariProfile->id) 
                @if(isset($bool) && !$bool)

                <form action="{{url('dashboard/add-friend/'. $perfil->id)}}">
                    <button class="btn btn-primary col-md-8 col-xs-offset-2 col-xs-8" type="submit">Follow</button>
                </form>

                @endif
                @if(isset($bool) && $bool)
                <form action="{{url('dashboard/remove-friend/'. $perfil->id)}}">
                    <button class="btn btn-danger col-md-8 col-xs-offset-2 col-xs-8" type="submit">Dejar de Seguir</button>
                </form>


                @endif
                @endif
                <div class="col-xs-12">
                    @if(isset($perfil) && $perfil->id == $usuariProfile->id)  
                    <form id="saveProfile" action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="col-md-10 col-xs-8">
                                <!--<button id="submitPerfil" class="upload col-md-12 col-md-offset-2 col-xs-5 btn btn-primary" style="display:none;" type="submit"><span class="glyphicon glyphicon-upload"></span></button>
                                <form action="{{url('usuari/profile/'. $perfil->id)}}">
                                    <button id="backPerfil" class="upload col-md-12 col-md-offset-2 col-xs-5 btn btn-danger" style="display:none;" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                                </form>-->
                                
                            </li>
                            
                            
                            <div id="submitPerfil" class="row" style="display:none;margin-bottom:10px;">
                                <div class="col-xs-offset-4 col-xs-6">
                                    <button  class=" btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
                                    <form action="{{url('usuari/profile/'. $perfil->name)}}">
                                    <button class=" btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                                </form>
                                </div>
                            </div>
                            <li class="col-md-10 col-md-offset-0 col-xs-offset-4 col-xs-8">
                                <button id="butoPerfil" class="upload col-md-12 col-md-offset-2 col-xs-5 btn btn-primary">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <input id="cameraPerfil" type="file" name="imatge"/>
                                </button>
                                @if(isset($mobil) && $mobil == true)
                                @if(isset($perfil) && $perfil->id == $usuariProfile->id)  


                                <form action="{{url('usuari/profile/'.$usuariProfile->name.'/maps')}}">
                                    <button class="btn btn-primary col-md-12 col-xs-offset-2 col-xs-8" type="submit">Edita mapa <span class="glyphicon glyphicon-pencil"></span></button></li>
                                </form>
                                

                            @endif
                            @endif    


                        </ul>
                    </form>

                    @elseif(!isset($perfil))
                    <form action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary upload col-xs-offset-1 col-xs-10">
                            <span class="glyphicon glyphicon-camera"></span>
                            <input type="file" name="image"/>
                        </button>
                        <button class="btn btn-success col-xs-offset-1 col-xs-10" type="submit"><span class="glyphicon glyphicon-upload"></span></button>
                    </form> 
                    @endif 
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            @if(isset($mobil) && $mobil == true)
            @if(isset($perfil))
            <div id="map_canvas" type_map="{{$perfil->mapa}}" class="col-xs-12" style="height:350px;"></div>            
            @endif

            @endif
        </div>
    </div>
    @if(isset($mobil) && $mobil == false)
    <div id="images" style="width: 100%;margin-bottom:50px;">
        @foreach($perfil->fotografies as $fotografia)

        <img src="{{url($fotografia->path)}}" class="image img-thumbnail"/>

        @endforeach
    </div>
    @else
    @if(count($perfil->fotografies)>0)
    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <script type="text/javascript" src="{{url('css/js/jquery-1.9.1.min.js')}}"></script>
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="{{url('css/js/jssor.js')}}"></script>
    <script type="text/javascript" src="{{url('css/js/jssor.slider.js')}}"></script>
    <script>
jQuery(document).ready(function ($) {
    var options = {
        $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlaySteps: 4, //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
        $AutoPlayInterval: 8000, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideDuration: 500, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
        $MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
        $SlideWidth: 200, //[Optional] Width of every slide in pixels, default value is width of 'slides' container
        //$SlideHeight: 150,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
        $SlideSpacing: 3, //[Optional] Space between each slide in pixels, default value is 0
        $DisplayPieces: 4, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
        $ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
        $UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
        $PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
        $DragOrientation: 1, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

        $BulletNavigatorOptions: {//[Optional] Options to specify and enable navigator or not
            $Class: $JssorBulletNavigator$, //[Required] Class to create navigator instance
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 0, //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1, //[Optional] Steps to go for each navigation request, default value is 1
            $Lanes: 1, //[Optional] Specify lanes to arrange items, default value is 1
            $SpacingX: 0, //[Optional] Horizontal space between each item in pixel, default value is 0
            $SpacingY: 0, //[Optional] Vertical space between each item in pixel, default value is 0
            $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
        },
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2, //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 4                                       //[Optional] Steps to go for each navigation request, default value is 1
        }
    };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var bodyWidth = document.body.clientWidth;
        if (bodyWidth)
            jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1150));
        else
            window.setTimeout(ScaleSlider, 30);
    }
    ScaleSlider();

    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
    //responsive code end
});
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div class="col-xs-12" id="slider1_container" style="position: relative; top: 0px; left: 0px; height: 150px; overflow: hidden; margin:10px 0 20px 0">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                 background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: {{url('img/loading.gif')}} no-repeat center center;
                 top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div class="col-xs-12" u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; height: 150px; overflow: hidden;">
            @if(isset($perfil)&&($usuariProfile))
            @foreach($perfil->fotografies as $fotografies)

            <div>
                <img u="image" src="{{url($fotografies->path)}}" />
                <img u="thumb" src="{{url($fotografies->path)}}" />
            </div>
            @endforeach
            @endif

        </div>

        <!-- Bullet Navigator Skin Begin -->

        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb03" style="position: absolute; bottom: 4px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="position: absolute; width: 21px; height: 21px; text-align:center; line-height:21px; color:white; font-size:12px;"><div u="numbertemplate"></div></div>
        </div>
        <!-- Bullet Navigator Skin End -->

        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 03 css */
            /*
            .jssora03l              (normal)
            .jssora03r              (normal)
            .jssora03l:hover        (normal mouseover)
            .jssora03r:hover        (normal mouseover)
            .jssora03ldn            (mousedown)
            .jssora03rdn            (mousedown)
            */
            .jssora03l, .jssora03r, .jssora03ldn, .jssora03rdn
            {
                position: absolute;
                cursor: pointer;
                display: block;
                background: url(/wildflash/public/css/js/img/a03.png) no-repeat;
                overflow:hidden;
            }
            .jssora03l { background-position: -3px -33px; }
            .jssora03r { background-position: -63px -33px; }
            .jssora03l:hover { background-position: -123px -33px; }
            .jssora03r:hover { background-position: -183px -33px; }
            .jssora03ldn { background-position: -243px -33px; }
            .jssora03rdn { background-position: -303px -33px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora03l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora03r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">jQuery Slider</a>
    </div>
    <!-- Jssor Slider End -->
    @endif
    @endif

    @section('menu')
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



    @show



</div>

@show
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
<script src="/wildflash/public/js/Marker.js"></script>
<script src="/wildflash/public/js/Profile.js"></script>
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
