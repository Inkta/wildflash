@extends('app')
@section('css')
<link href="{{url('/css/proba.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <div class="navigation" id="nav">
        <div class="item user">
            <img src="imgApp/home.png" alt="" width="199" height="199" class="circle"/>
            <a href="#" class="icon"></a>
            <h2>User</h2>
            <ul>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Properties</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
        </div>
        <div class="item home">
            <img src="imgApp/home.png" alt="" width="199" height="199" class="circle"/>
            <a href="#" class="icon"></a>
            <h2>Home</h2>
            <ul>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        ...
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#nav > div').hover(
                function () {
                    var $this = $(this);
                    $this.find('img').stop().animate({
                        'width': '199px',
                        'height': '199px',
                        'top': '-25px',
                        'left': '-25px',
                        'opacity': '1.0'
                    }, 500, 'easeOutBack', function () {
                        $(this).parent().find('ul').fadeIn(700);
                    });

                    $this.find('a:first,h2').addClass('active');
                },
                function () {
                    var $this = $(this);
                    $this.find('ul').fadeOut(500);
                    $this.find('img').stop().animate({
                        'width': '52px',
                        'height': '52px',
                        'top': '0px',
                        'left': '0px',
                        'opacity': '0.1'
                    }, 5000, 'easeOutBack');

                    $this.find('a:first,h2').removeClass('active');
                }
        );
    });
</script>
@stop
@endsection