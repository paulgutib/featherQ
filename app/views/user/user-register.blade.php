@extends('user.user')

@section('title')
<h3>Sign-Up!</h3>
@stop

@section('content')
{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
	<ul>
		@foreach($errors->all() as $error)
	    <li>{{ $error }}</li>
	  @endforeach
	</ul>
	<div>
    {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Username')) }}
  </div>
  <div>
    {{ Form::text('phone', null, array('class'=>'input-block-level', 'placeholder'=>'Phone')) }}
  </div>
  <div>
    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email')) }}
  </div>
  <div>
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
  </div>
  <div>  
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
  </div>
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop