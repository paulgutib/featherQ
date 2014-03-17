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
	  @if (isset($services))
		  @foreach ($services as $key => $column)
		  <tr>
				<td>{{ $services[$key]['service_name'] }} </td>
				<td>
					Yes {{ Form::radio('service_status_' . $services[$key]['service_id'], 1, 1 == $services[$key]['status']) }}
					No {{ Form::radio('service_status_' . $services[$key]['service_id'], 0, 0 == $services[$key]['status']) }}
				</td>
				<td>{{ Form::checkbox('service_delete[]', $services[$key]['service_id']) }}</td>
		  </tr>
		  @endforeach
		@endif
	</table>
	<br/>
	{{ Form::submit('Save Changes') }}
	{{Form::close()}}
</div>

@stop