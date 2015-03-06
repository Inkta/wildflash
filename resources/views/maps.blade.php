@extends('app')

@section('content')
<?php $i = 0; ?>
<div class="container">
    @if(isset($mapas))
    @foreach($mapas as $nom=>$mapa)
    <?php
    if ($i == 0 || is_int($i / 3))
        echo '<div class="row">';
    ?>
    <div class='col-xs-4'>
        <p>{{$nom}}</p>
        <img class='img-circle' width="80px;" height="80px;" src="{{url($mapa)}}"/>
        <a href="{{url("guardarmapa/".$nom)}}">Select Map</a>
    </div>

    <?php
    if ($i == 0 || is_int($i / 3))
        echo '</div>';
    ?>

<?php $i++; ?>


    @endforeach
    @endif
</div>
@section('scripts')

@stop
@endsection
