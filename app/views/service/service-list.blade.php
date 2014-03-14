@extends('service.service')

@section('content')
<div>
	<h3>Available Services: </h3>
	{{Form::open(array('url' => 'service/updatedelete'))}}
	<table cellpadding="1" border="1px">
		<tr>
			<td>Service Name</td>
			<td>Active? (Y/N)</td>
			<td>Delete</td>
	  </tr>
	  @if (isset($available_services))
		  @foreach ($available_services as $service_id => $service_name)
		  <tr>
				<td>{{{ $service_name }}}</td>
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
		{{ Form::open(array('url' => 'service/edit')) }}
		<div>
			<h3>EDIT SERVICE</h3>
		  {{ Form::select('service_list', $all_services) }}
		  {{ Form::text('new_service_name', null, array('class'=>'input-block-level', 'placeholder'=>'New Service Name')) }}
		  {{ Form::submit('UPDATE') }}
		</div>
		{{ Form::close() }}
  </div>
@stop