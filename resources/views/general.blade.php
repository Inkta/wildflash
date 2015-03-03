@extends('app')

@section('content')
<div class="container">
    @if (isset($fotografies))
    
    @for ($i = 0; $i < count($fotografies); $i++)
        @if ($i%3==0) 
        <div class="row">
        @endif
        
        <div class="col-xs-4">
            <a href="general/{{$fotografies[$i]->id}}" ><img src="{{ $fotografies[$i]->path }}" height="180" width="360"/></a>
        </div>
        
        @if (($i+1)%3==0)
        </div>
        @endif
    @endfor
    @endif

</div>
@endsection
