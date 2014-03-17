@section('content')

<h3>Edit User</h3>

<div>
{{ Form::open(array('url'=>'user/create-via-admin')) }}
  {{ Form::hidden('user_id', $user_id) }}
	{{ Form::text('username', $username, array('placeholder'=>'Username')) }}
	{{ Form::text('phone', $phone, array('placeholder'=>'Phone')) }}
	{{ Form::text('email', $email, array('placeholder'=>'Email')) }}
	Active?
	Yes {{ Form::radio('user_status_' . $user_id, 1, 1 == $status) }}
	No {{ Form::radio('user_status_' . $user_id, 0, 0 == $status) }}
	{{ Form::submit('UPDATE') }}
{{ Form::close() }}
<div>

@stop