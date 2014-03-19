@section('content')

<h3>Create User</h3>

<div>
{{ Form::open(array('url'=>'user/create')) }}
	<div>
	  {{Form::hidden('add_type', 'admin')}}
	</div>
	<div>
		{{Form::label('Username')}} {{ Form::text('username') }}
	</div>
	<div>
		{{Form::label('Role')}} {{ Form::select('role', $roles) }}
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
	{{ Form::submit('CREATE') }}
{{ Form::close() }}
<div>

@stop