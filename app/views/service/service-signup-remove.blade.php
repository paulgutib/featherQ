@extends('user.user')

@section('title')
<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>SERVICE SIGNUP PAGE</h3>
@stop

@section('content')
	<h1>NO REQUIREMENTS!! PLEASE PROCEED TO CONTINUE</h1>
	{{Form::open(array('url' => 'user/service/process')}}
		{{Form::submit('Proceed')}}
	{{Form::close()}}
@stop