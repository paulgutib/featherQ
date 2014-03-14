@extends('user.user')

@section('title')
<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>DASHBOARD</h3>
@stop

@section('content')
	<h4>Sign up to an Available Service</h4>
	<div>
		{{Form::open(array('url' => 'service/signup-remove'))}}
		<table cellpadding="1" border="1px">
			<tr>
				<td>Service Name</td>
				<td>Sign Up / Remove</td>
		  </tr>
		  @if (isset($available_services))
			  @foreach ($available_services as $service_id => $service_name)
			  <tr>
					<td>{{{ $service_name }}}</td>
					<td>{{Form::button($signup_type[$service_id], array('onClick' => 'window.location = \'/user/service/' . $service_id . '\';'))}}</td>
			  </tr>
			  @endforeach
			@endif
		</table>
		{{Form::close()}}
	</div>
@stop