@extends('user.user')

@section('title')
<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>DASHBOARD</h3>
@stop

@section('content')
<div>
	<h3>Available Services: </h3>
	{{Form::open(array('url' => 'service/updatedelete'))}}
	<table cellpadding="1" border="1px">
		<tr>
			<td>Service Name</td>
			<td>Currently Serving</td>
			<td>Next Served</td>
			<td>Total Queue</td>
			<td>Get a Number</td>
			<td>Your Number</td>
			<td>Active? (Y/N)</td>
			<td>Delete</td>
	  </tr>
	  @if (isset($available_services))
		  @foreach ($available_services as $service_id => $service_name)
		  <tr>
				<td>{{{ $service_name }}}</td>
				<td> - </td>
				<td> - </td>
				<td> - </td>
				<td> -</td>
				<td> - </td>
				<td>
					Yes {{ Form::radio('service_status_' . $service_id, 1, 1 == $services_status[$service_id]) }}
					No {{ Form::radio('service_status_' . $service_id, 0, 0 == $services_status[$service_id]) }}
				</td>
				<td>{{ Form::checkbox('service_delete[]', $service_id) }}</td>
		  </tr>
		  @endforeach
		@endif
	</table>
	<br/>
	{{ Form::submit('DELETE/UPDATE STATUS') }}
	{{Form::close()}}
</div>
	<div>
		{{ Form::open(array('url' => 'service/add')) }}
		<div>
			<h3>ADD SERVICE</h3>
			{{ Form::text('service_name', null, array('class'=>'input-block-level', 'placeholder'=>'Service Name')) }}
			{{ Form::submit('ADD') }}
		</div>
		{{ Form::close() }}
		{{ Form::open(array('url' => 'service/update')) }}
		<div>
			<h3>EDIT SERVICE</h3>
		  {{ Form::select('service_list', $all_services) }}
		  {{ Form::text('new_service_name', null, array('class'=>'input-block-level', 'placeholder'=>'New Service Name')) }}
		  {{ Form::submit('UPDATE') }}
		</div>
		{{ Form::close() }}
  </div>
  <br/><br/><br/><br/>
  <div>
		<h3>Available Terminal Types: </h3>
		{{Form::open(array('url' => 'terminal/delete-type'))}}
		<table cellpadding="1" border="1px">
			<tr>
				<td>Terminal Type Name</td>
				<td>Delete</td>
		  </tr>
		  @if (isset($terminal_type_list))
			  @foreach ($terminal_type_list as $type_id => $type_name)
			  <tr>
					<td>{{{ $type_name }}}</td>
					<td>{{ Form::checkbox('terminal_type_delete[]', $type_id) }}</td>
			  </tr>
			  @endforeach
			@endif
		</table>
		<br/>
		{{ Form::submit('DELETE') }}
		{{Form::close()}}
	</div>
  <div>
		{{ Form::open(array('url' => 'terminal/add-type')) }}
		<div>
			<h3>ADD TERMINAL TYPE</h3>
		  {{ Form::text('terminal_type_name', null, array('class'=>'input-block-level', 'placeholder'=>'Terminal Type Name')) }}
		  {{ Form::submit('ADD') }}
		</div>
		{{ Form::close() }}
		{{ Form::open(array('url' => 'terminal/update-type')) }}
		<div>
			<h3>EDIT TERMINAL TYPE</h3>
		  {{ Form::select('terminal_type_list', $all_terminal_types) }}
		  {{ Form::text('new_terminal_type_name', null, array('class'=>'input-block-level', 'placeholder'=>'New Terminal Type Name')) }}
		  {{ Form::submit('UPDATE') }}
		</div>
		{{ Form::close() }}
  </div>
  <br/><br/><br/><br/>

@stop