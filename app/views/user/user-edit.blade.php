@section('content')

<h3>Edit User</h3>

<div>
{{ Form::open(array('url'=>'user/update')) }}
  <div>
	  {{Form::hidden('add_type', 'admin')}}
	</div>
	<div>
	  {{Form::hidden('user_id', $user_id)}}
	</div>
	<div>
		{{Form::label('Username')}} {{ Form::text('username', $username) }}
	</div>
	<div>
		{{Form::label('Role')}} {{ Form::select('role', $roles, $role_id) }}
	</div>
	<div>
		{{Form::label('Phone')}} {{ Form::text('phone', $phone) }}
	</div>
	<div>
		{{Form::label('Email')}} {{ Form::text('email', $email) }}
	</div>
	<div>
		{{Form::label('Password')}} {{ Form::password('password') }}
	</div>
	<div>
		{{Form::label('Confirm Password')}} {{ Form::password('password_confirmation') }}
	</div>
	<div>
		{{Form::label('Full Name')}} {{ Form::text('fullname', $fullname) }}
	</div>
	<div>
		{{Form::label('Birthdate')}}
			{{ Form::select('month', $months, $month) }}
			{{ Form::select('day', $days, $day) }}
			{{ Form::select('year', $years, $year) }}
	</div>
	<div>
		{{Form::label('Sex')}} {{ Form::select('sex', array('Male' => 'Male', 'Female' => 'Female'), $sex) }}
	</div>
	<div>
		{{Form::label('Location')}} {{ Form::text('location', $location) }}
	</div>
	<div>
		{{Form::label('Nationality')}} {{ Form::select('nationality', array('PH' => 'Philippines')) }}
	</div>
	{{ Form::submit('UPDATE') }}
{{ Form::close() }}
<div>

@stop