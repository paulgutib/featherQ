<h3>LOGIN</h3>

<div>
	{{ Form::open(array('url'=>'user/signin')) }}
	<div>
		{{Form::label('Username')}} {{Form::text('username')}}
	</div>
	<div>	
		{{Form::label('Password')}} {{Form::password('password')}}
	</div>
	<div>
		{{Form::submit('Login')}}
	</div>
  {{Form::close()}}
</div>

<h3>Sign-Up!</h3>

<div>
{{ Form::open(array('url'=>'user/create')) }}
	<div>
	  {{Form::hidden('add_type', 'public')}}
	</div>
  <div>
		{{Form::label('Username')}} {{ Form::text('username') }}
	</div>
	<div>
		{{Form::label('Phone')}} {{ Form::text('phone') }}
	</div>
	<div>
		{{Form::label('Email')}} {{ Form::text('email') }}
	</div>
	<div>
		{{Form::label('Password')}} {{ Form::password('password') }}
	</div>
	<div>
		{{Form::label('Confirm Password')}} {{ Form::password('password_confirmation') }}
	</div>
	<div>
		{{Form::label('Full Name')}} {{ Form::text('fullname') }}
	</div>
	<div>
		{{Form::label('Birthdate')}}
			{{ Form::select('month', $months) }}
			{{ Form::select('day', $days) }}
			{{ Form::select('year', $years) }}
	</div>
	<div>
		{{Form::label('Sex')}} {{ Form::select('sex', array('Male' => 'Male', 'Female' => 'Female')) }}
	</div>
	<div>
		{{Form::label('Location')}} {{ Form::text('location') }}
	</div>
	<div>
		{{Form::label('Nationality')}} {{ Form::select('nationality', array('PH' => 'Philippines')) }}
	</div>
  <div>
		{{ Form::submit('Register') }}
  </div>
{{ Form::close() }}
<div>

<div>
	@if (Session::has('message'))
		{{Session::get('message')}}
	@elseif (Session::has('error'))
		{{Session::get('error')}}
	@endif
</div>