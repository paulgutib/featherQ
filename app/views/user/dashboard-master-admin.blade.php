@section('title')
<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>DASHBOARD</h3>
@stop

@section('content')
<div>
	<h3>Available Services: </h3>
	{{Form::open(array('url' => 'service/delete'))}}
	<table cellpadding="1" border="1px">
		<tr>
			<td>Service Name</td>
			<td>Currently Serving</td>
			<td>Next Served</td>
			<td>Total Queue</td>
			<td>Get a Number</td>
			<td>Your Number</td>
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
				<td>{{ Form::checkbox('service_delete[]', $service_id) }}</td>
		  </tr>
		  @endforeach
		@endif
	</table>
	<br/>
	{{ Form::submit('DELETE') }}
	{{Form::close()}}
</div>

<div>
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
</div>

@stop