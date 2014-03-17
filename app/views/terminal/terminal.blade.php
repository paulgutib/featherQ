@yield('title')

<div>
	<strong>{{link_to('/', 'Dashboard')}}</strong>
	<strong>{{link_to('service/list', 'Services')}}</strong>
	<strong>{{link_to('terminal/list', 'Terminals')}}</strong>
	<strong>{{link_to('user/list', 'Users')}}</strong>
</div>
<br/>
<h2>TERMINALS</h2>
<div>
	<strong>{{link_to('terminal/list', 'List')}}</strong>
	<strong>{{link_to('terminal/add', 'Add')}}</strong>
</div>

@yield('content')

<div>
	@if (Session::has('message'))
		{{Session::get('message')}}
	@elseif (Session::has('error'))
		{{Session::get('error')}}
	@endif
</div>

@yield('footer')