@section('content')

<h3>Create User</h3>

<div>
{{ Form::open(array('url'=>'user/create-via-admin')) }}
	{{ Form::text('username', null, array('placeholder'=>'Username')) }}
	{{ Form::text('phone', null, array('placeholder'=>'Phone')) }}
	{{ Form::text('email', null, array('placeholder'=>'Email')) }}
	{{ Form::password('password', null, array('placeholder'=>'Password')) }}
	{{ Form::password('password_confirmation', null, array('placeholder'=>'Confirm Password')) }}
	{{ Form::submit('CREATE') }}
{{ Form::close() }}
<div>

@stop