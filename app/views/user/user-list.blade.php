@section('content')

<h3>Users</h3>

{{Form::open(array('url' => 'user/updatedelete'))}}
<table cellpadding="1" border="1px">
	<tr>
		<td>Username</td>
		<td>Role</td>
		<td>Email</td>
		<td>Phone</td>
		<td>Active? (Y/N)</td>
		<td>Delete</td>
		<td>Edit</td>
  </tr>
  @if (isset($users))
	  @foreach ($users as $key => $column)
	  <tr>
	  	<td>{{ $users[$key]['username'] }} </td>
	  	<td>{{ $users[$key]['role'] }}</td>
	  	<td>{{ $users[$key]['email'] }} </td>
	  	<td>{{ $users[$key]['phone'] }} </td>
	  	<td>
				Yes {{ Form::radio('user_status_' . $users[$key]['user_id'], 1, 1 == $users[$key]['status']) }}
				No {{ Form::radio('user_status_' . $users[$key]['user_id'], 0, 0 == $users[$key]['status']) }}
			</td>
			<td>{{ Form::checkbox('user_delete[]', $users[$key]['user_id']) }}</td>
			<td>{{ link_to('user/edit/' . $users[$key]['user_id'], 'EDIT')}}</td>
	  </tr>
	  @endforeach
	@endif
</table>
{{ Form::submit('Save Changes') }}
{{Form::close()}}

@stop