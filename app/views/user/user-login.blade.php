@extends('user.user')

@section('title')
<h3>Login</h3>
@stop

@section('content')
{{ Form::open(array('url'=>'user/signin', 'class'=>'form-login')) }}
	<div>
		<div class="form-group">
			{{Form::label('Username')}} {{Form::text('username')}}
		</div>
		<div class="form-group">
			{{Form::label('Password')}} {{Form::password('password')}}
		</div>
		{{Form::submit('Login')}}
  </div>
{{Form::close()}}
@stop
