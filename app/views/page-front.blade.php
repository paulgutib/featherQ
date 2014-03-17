<h3>LOGIN</h3>

<div>
	{{ Form::open(array('url'=>'user/signin')) }}
		{{Form::label('Username')}} {{Form::text('username')}}
		{{Form::label('Password')}} {{Form::password('password')}}
		{{Form::submit('Login')}}
  {{Form::close()}}
</div>

<h3>Sign-Up!</h3>

<div>
{{ Form::open(array('url'=>'user/create')) }}
	{{ Form::text('username', null, array('placeholder'=>'Username')) }}
	{{ Form::text('phone', null, array('placeholder'=>'Phone')) }}
	{{ Form::text('email', null, array('placeholder'=>'Email')) }}
	{{ Form::password('password', null, array('placeholder'=>'Password')) }}
	{{ Form::password('password_confirmation', null, array('placeholder'=>'Confirm Password')) }}
	{{ Form::submit('Register') }}
{{ Form::close() }}
<div>

<div>
	@if (Session::has('message'))
		{{Session::get('message')}}
	@elseif (Session::has('error'))
		{{Session::get('error')}}
	@endif
</div>