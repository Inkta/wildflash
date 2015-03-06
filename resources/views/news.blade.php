@extends('app')
@section('content')
<div class="container">
    @if(isset($fotos))
    @foreach($fotos as $foto)
    <div class="row">
        <img src="{{url($foto->path)}}" width="800" height="600"/>
        <div class="row">
            <div class="boxComents" class="col-xs-12">   
                <div id="commentsInv{{$foto->id}}" style="display:none;">
                    @foreach($foto->comentaris as $comentari)
                    <div class="comentari">
                        <p><a href="{{url('usuari/profile/'.$comentari->user->name)}}"> 
                                {{$comentari->user->name}}</a>{{$comentari->comentari}}</p>
                    </div>
                    @endforeach
                </div>
                @if(count($foto->comentaris)>0)
                <div id="mostraComentaris{{$foto->id}}">
                    <button id="{{$foto->id}}" onclick="mostraComentaris(this)"> Mostra Comentaris</button>
                </div>
                @else
                <p>Ningu ha comentat aquesta foto, sigues el primer!</p>
                @endif


                <form action="{{url('comments/'.$foto->id)}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea name="comentari" cols="50" rows="3"></textarea>
                    <input type="submit" value="Comentar"/>
                </form>

            </div>
        </div>
    </div>
    @endforeach

    <?php echo $fotos->render(); ?>
    @endif



</div>

@section('scripts')
<script src="js/Comentaris.js"></script>
@stop
@endsection