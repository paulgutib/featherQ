@section('content')

<div>
		<h3>Terminal Types: </h3>
		{{Form::open(array('url' => 'terminal/delete-type'))}}
		<table cellpadding="1" border="1px">
			<tr>
				<td>Terminal Type Name</td>
				<td>Delete</td>
		  </tr>
		  @if (isset($types))
			  @foreach ($types as $key => $column)
			  <tr>
					<td>{{{ $types[$key]['name'] }}}</td>
					<td>{{ Form::checkbox('type_delete[]', $types[$key]['type_id']) }}</td>
			  </tr>
			  @endforeach
			@endif
		</table>
		<br/>
		{{ Form::submit('DELETE') }}
		{{Form::close()}}
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
		  @if (isset($nodes))
			  @foreach ($nodes as $key => $column)
			  <tr>
					<td>{{{ $nodes[$key]['name'] }}}</td>
					<td>{{{ $nodes[$key]['type'] }}}</td>
					<td>
						Yes {{ Form::radio('terminal_status_' . $nodes[$key]['terminal_id'], 1, 1 == $nodes[$key]['status']) }}
						No {{ Form::radio('terminal_status_' . $nodes[$key]['terminal_id'], 0, 0 == $nodes[$key]['status']) }}
					</td>
					<td>{{ Form::checkbox('node_delete[]', $nodes[$key]['terminal_id']) }}</td>
			  </tr>
			  @endforeach
			@endif
		</table>
		<br/>
		{{ Form::submit('Save Changes') }}
		{{Form::close()}}
		
	</div>
  
  @stop