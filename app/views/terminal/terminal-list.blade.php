@extends('service.service')

@section('content')

<div>
		<h3>Terminal Types: </h3>
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
  <div>
		<h3>Terminal Nodes:</h3>
		{{Form::open(array('url' => 'terminal/updatedelete-node'))}}
		<table cellpadding="1" border="1px">
			<tr>
				<td>Terminal Node Name</td>
				<td>Terminal Type</td>
				<td>Ready to Take Queues? (Y/N)</td>
				<td>Delete</td>
		  </tr>
		  @if (isset($terminal_node_list))
			  @foreach ($terminal_node_list as $terminal_id => $terminal_name)
			  <tr>
					<td>{{{ $terminal_name }}}</td>
					<td>{{{ $terminal_types[$terminal_id] }}}</td>
					<td>
						Yes {{ Form::radio('terminal_status_' . $terminal_id, 1, 1 == $terminal_status[$terminal_id]) }}
						No {{ Form::radio('terminal_status_' . $terminal_id, 0, 0 == $terminal_status[$terminal_id]) }}
					</td>
					<td>{{ Form::checkbox('terminal_node_delete[]', $terminal_id) }}</td>
			  </tr>
			  @endforeach
			@endif
		</table>
		<br/>
		{{ Form::submit('UPDATE/DELETE') }}
		{{Form::close()}}
		{{ Form::open(array('url' => 'terminal/add-node')) }}
		<div>
			<h3>ADD TERMINAL NODE</h3>
		  {{ Form::text('terminal_node_name', null, array('class'=>'input-block-level', 'placeholder'=>'Terminal Node Name')) }}
		  {{ Form::select('terminal_type_list', $all_terminal_types) }}
		  {{ Form::submit('ADD') }}
		</div>
		{{ Form::close() }}
	</div>
  
  @stop