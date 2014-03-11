@if(Auth::check())
	<strong>{{link_to('user/logout', 'Log Out')}}</strong>
	
	<h2>Welcome, {{{Auth::user()->username}}}!</h2>
	<h3>DASHBOARD</h3>
	
	<div>
		<h3>Available Services: </h3>
		{{Form::open()}}
		<table cellpadding="1" border="1px">
			<tr>
				<td>Service Name</td>
				<td>Currently Serving</td>
				<td>Next Served</td>
				<td>Total Queue</td>
				<td>Get a Number</td>
				<td>Your Number</td>
		  </tr>
		  <tr>
				<td>-</td>
				<td> - </td>
				<td> - </td>
				<td> - </td>
				<td>{{Form::submit('Pick')}}</td>
				<td> - </td>
		  </tr>
		  <tr>
				<td>-</td>
				<td> - </td>
				<td> - </td>
				<td> - </td>
				<td>{{Form::submit('Pick')}}</td>
				<td> - </td>
		  </tr>
		  <tr>
				<td>-</td>
				<td> - </td>
				<td> - </td>
				<td> - </td>
				<td>{{Form::submit('Pick')}}</td>
				<td> - </td>
		  </tr>
		</table>
		{{Form::close()}}
	</div>
	
	
@else
	<h1>Access denied!</h1>
@endif

