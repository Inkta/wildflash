@extends('app')
@section('css')
<link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" charset="utf-8"/>
<link href="{{url('/css/home.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row">
        @if(isset($mobil) && $mobil == true)
        <div class='col-md-1'>
            <ul id="navigation">
                <li class="home"><a href="{{url('home')}}" title="Home"></a></li>
                <li class="news"><a href="{{url('news')}}" title="News"></a></li>
                <li class="followers"><a href="{{url('dashboard')}}" title="Followers"></a></li>
            </ul>

        </div>
        @endif
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
                <a href="{{url('dashboard/add-friend/'. $perfil->id)}}">Follow</a>
                @endif
                @if(isset($bool) && $bool)
                <a href="{{url('dashboard/remove-friend/'. $perfil->id)}}">Dejar de seguir</a>
                @endif
                @endif
                <div class="col-xs-12">
                    @if(isset($perfil) && $perfil->id == $usuariProfile->id)  
                    <form id="saveProfile" action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="col-md-10 col-md-offset-0 col-xs-offset-2 col-xs-8">
                                <button id="butoPerfil" class="upload col-md-12  col-xs-offset-2 col-xs-8">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <input id="cameraPerfil" type="file" name="imatge"/>
                                </button>
                            </li>
                            <li class="col-md-10 col-md-offset-0 col-xs-offset-2 col-xs-8"><button id="submitPerfil" class="upload col-md-12  col-xs-offset-2 col-xs-8" style="display:none;" type="submit"><span class="glyphicon glyphicon-upload"></span></button></li>
                            <li class="col-md-10 col-md-offset-0 col-xs-offset-2 col-xs-8"><button class="upload col-md-12  col-xs-offset-2 col-xs-8" type="submit"><a href="{{url('dashboard')}}"></a><span class="glyphicon glyphicon-user"></span></button></li>
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
        <div class="col-xs-12 col-md-8">
            @if(isset($mobil) && $mobil == true)
            @if(isset($perfil))
            <div id="map_canvas" type_map="{{$perfil->mapa}}" class="col-xs-12" style="height:400px;"></div>            
            @endif
            @if(isset($perfil) && $perfil->id == $usuariProfile->id)  
            <a href="{{url('usuari/profile/'.$usuariProfile->name.'/maps')}}">Personalitzar mapa</a>
            @endif
            @endif
        </div>
    </div>
    @if(isset($mobil) && $mobil == false)
    <div id="images" style="width: 100%;">
        @foreach($perfil->fotografies as $fotografia)

        <img src="{{url($fotografia->path)}}" class="image img-thumbnail"/>

        @endforeach
    </div>
    @else
    <!--******************************************SLIDE PROVA*******************************************************-->
    <script type="text/javascript" src="{{url('/css/js/jquery-1.9.1.min.js')}}"></script>
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="{{url('/css/js/jssor.js')}}"></script>
    <script type="text/javascript" src="{{url('/css/js/jssor.slider.js')}}"></script>
    <script>

jQuery(document).ready(function ($) {

    var _SlideshowTransitions = [
        //Fade in L
        {$Duration: 1200, x: 0.3, $During: {$Left: [0.3, 0.7]}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade out R
        , {$Duration: 1200, x: -0.3, $SlideOut: true, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade in R
        , {$Duration: 1200, x: -0.3, $During: {$Left: [0.3, 0.7]}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade out L
        , {$Duration: 1200, x: 0.3, $SlideOut: true, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}

        //Fade in T
        , {$Duration: 1200, y: 0.3, $During: {$Top: [0.3, 0.7]}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade out B
        , {$Duration: 1200, y: -0.3, $SlideOut: true, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade in B
        , {$Duration: 1200, y: -0.3, $During: {$Top: [0.3, 0.7]}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade out T
        , {$Duration: 1200, y: 0.3, $SlideOut: true, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}

        //Fade in LR
        , {$Duration: 1200, x: 0.3, $Cols: 2, $During: {$Left: [0.3, 0.7]}, $ChessMode: {$Column: 3}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade out LR
        , {$Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: {$Column: 3}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade in TB
        , {$Duration: 1200, y: 0.3, $Rows: 2, $During: {$Top: [0.3, 0.7]}, $ChessMode: {$Row: 12}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade out TB
        , {$Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: {$Row: 12}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}

        //Fade in LR Chess
        , {$Duration: 1200, y: 0.3, $Cols: 2, $During: {$Top: [0.3, 0.7]}, $ChessMode: {$Column: 12}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade out LR Chess
        , {$Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: {$Column: 12}, $Easing: {$Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade in TB Chess
        , {$Duration: 1200, x: 0.3, $Rows: 2, $During: {$Left: [0.3, 0.7]}, $ChessMode: {$Row: 3}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade out TB Chess
        , {$Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: {$Row: 3}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}

        //Fade in Corners
        , {$Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]}, $ChessMode: {$Column: 3, $Row: 12}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
        //Fade out Corners
        , {$Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]}, $SlideOut: true, $ChessMode: {$Column: 3, $Row: 12}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}

        //Fade Clip in H
        , {$Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: {$Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade Clip out H
        , {$Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: {$Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade Clip in V
        , {$Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: {$Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
        //Fade Clip out V
        , {$Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: {$Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2}
    ];

    var options = {
        $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 1500, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
        $ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideDuration: 800, //Specifies default duration (swipe) for slide in milliseconds

        $SlideshowOptions: {//[Optional] Options to specify and enable slideshow or not
            $Class: $JssorSlideshowRunner$, //[Required] Class to create instance of slideshow
            $Transitions: _SlideshowTransitions, //[Required] An array of slideshow transitions to play slideshow
            $TransitionsOrder: 1, //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
            $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
        },
        $ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
        },
        $ThumbnailNavigatorOptions: {//[Optional] Options to specify and enable thumbnail navigator or not
            $Class: $JssorThumbnailNavigator$, //[Required] Class to create thumbnail navigator instance
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always

            $ActionMode: 1, //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
            $SpacingX: 8, //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
            $DisplayPieces: 10, //[Optional] Number of pieces to display, default value is 1
            $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
        }
    };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
        if (parentWidth)
            jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
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
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 100%;
         height: 600px; background: #191919; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                 background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(http://localhost/wildflash/public/css/js/img/loading.gif) no-repeat center center;
                 top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" class="col-xs-12" style="cursor: move; position: absolute; left: 0px; top: 0px; height: 600px; overflow: hidden;">

            @if(isset($perfil)&&($usuariProfile))
            @foreach($perfil->fotografies as $fotografies)

            <div>
                <img u="image" src="{{url($fotografies->path)}}" />
                <img u="thumb" src="{{url($fotografies->path)}}" />
            </div>
            @endforeach
            @endif


        </div>

        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 05 css */
            /*
            .jssora05l              (normal)
            .jssora05r              (normal)
            .jssora05l:hover        (normal mouseover)
            .jssora05r:hover        (normal mouseover)
            .jssora05ldn            (mousedown)
            .jssora05rdn            (mousedown)
            */
            .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
            {
                position: absolute;
                cursor: pointer;
                display: block;
                background: url(http://localhost/wildflash/public/css/js/img/a17.png) no-repeat;
                overflow:hidden;
            }
            .jssora05l { background-position: -10px -40px; }
            .jssora05r { background-position: -70px -40px; }
            .jssora05l:hover { background-position: -130px -40px; }
            .jssora05r:hover { background-position: -190px -40px; }
            .jssora05ldn { background-position: -250px -40px; }
            .jssora05rdn { background-position: -310px -40px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->

        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 01 css */
                /*
                .jssort01 .p           (normal)
                .jssort01 .p:hover     (normal mouseover)
                .jssort01 .pav           (active)
                .jssort01 .pav:hover     (active mouseover)
                .jssort01 .pdn           (mousedown)
                */
                .jssort01 .w {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }

                .jssort01 .c {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 68px;
                    height: 68px;
                }

                .jssort01 .p:hover .c, .jssort01 .pav:hover .c, .jssort01 .pav .c {
                    background: url(http://localhost/wildflash/public/css/js/img/t01.png) center center;
                    border-width: 0px;
                    top: 2px;
                    left: 2px;
                    width: 68px;
                    height: 68px;
                }

                .jssort01 .p:hover .c, .jssort01 .pav:hover .c {
                    top: 0px;
                    left: 0px;
                    width: 70px;
                    height: 70px;
                    border: #fff 1px solid;
                }
            </style>
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                    <div class=w><div u="thumbnailtemplate" style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></div></div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
    </div>
    <!-- Thumbnail Navigator Skin End -->
    @endif


    @section('menu')
    @if (isset($mobil) && $mobil == false)
    <div class="row" id="footer" style="position:fixed;bottom:0px;left:0px;">
        <div class="col-xs-12" >
            <form action="{{url('uploadImage')}}" id="formulariImatge" method="POST" enctype="multipart/form-data">
                <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="enviar" type="hidden" value="upload">
                <input id="cameraAlbum" type="file" name="image" capture="camera" accept="image/*"/>
            </form> 
        </div>
    </div>
    @else

    @endif



    @show



</div>
</div>
@show
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
