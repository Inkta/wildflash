@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-3">
            <div class="row">
                <div class="col-xs-10 col-offset-xs-2 ">
                    <img class="img-circle" src="{{Auth::user()->fotografiaPerfil}}"/>
                </div>
                
            </div>
             
            <div class="row">
                <div class="col-xs-12"><h2 class="text-center">{{ Auth::user()->name }}</h2></div>
                <div class="col-xs-12"><h3 class="text-center">{{Auth::user()->rang}}</h3></div>
                <div class="col-xs-12">
                    <form action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="imatge"/>
                        <input type="submit" value="Upload"/>
                        
                </form>
                </div>
            </div>
        </div>
        <div class="col-xs-9">
            <div id="map_canvas" class="col-xs-12" style="height:400px;"></div>
        </div>
    </div>
</div>
@endsection
