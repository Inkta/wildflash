@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default col-md-8 col-md-offset-2 nopadding">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{url('/auth/register')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							
							<div class="col-md-10 col-md-offset-1">
								<input placeholder="Name" type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							
							<div class="col-md-10 col-md-offset-1">
								<input placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							
							<div class="col-md-10 col-md-offset-1">
								<input placeholder="Password" type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							
							<div class="col-md-10 col-md-offset-1">
								<input placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<button type="submit" class="btn btn-primary col-md-12">
									Register
								</button>
							</div>
						</div>
						<div class="form-group">
						    <div class="col-md-10 col-md-offset-1">
							<h4 style="color:white">REGISTRA'T A <span style="font-size:22px">WILDFLASH<span></h4>
							<p style="color:white">Apunta't amb nosaltres. Entra a un món de comunicació fotogràfica. No voldràs que t'ho expliquin no?</p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var classes = ['primera','segona','tercera','quarta'];
	var i=0;
	document.body.setAttribute("class", "quarta");
	setInterval(function(){
	    
		document.body.className=""+classes[i]+"";
		
        i++;		
		if(i==4){
		 i=0;
		}
	}, 8000);
		
		</script>
@endsection