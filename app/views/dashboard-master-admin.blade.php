<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>DASHBOARD</h3>

<div>
	<strong>{{link_to('/', 'Dashboard')}}</strong>
	<strong>{{link_to('service/list', 'Services')}}</strong>
	<strong>{{link_to('terminal/list', 'Terminals')}}</strong>
	<strong>{{link_to('user/list', 'Users')}}</strong>
</div>
