@yield('title')

<div>
	<strong>{{link_to('user/dashboard', 'Dashboard')}}</strong>
	<strong>{{link_to('service/list', 'Services')}}</strong>
	<strong>{{link_to('terminal/list', 'Terminals')}}</strong>
</div>

<h2>TERMINAL LISTING</h2>

@yield('content')

<div>
	@if (Session::has('message'))
		{{Session::get('message')}}
	@elseif (Session::has('error'))
		{{Session::get('error')}}
	@endif
</div>

@yield('footer')