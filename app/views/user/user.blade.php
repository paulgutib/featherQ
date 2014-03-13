@yield('title')

<div>
	@if (Session::has('message'))
		{{Session::get('message')}}
	@elseif (Session::has('error'))
		{{Session::get('error')}}
	@endif
</div>

@if (!Auth::check())
<div>
	<strong>{{link_to('user/login', 'Login')}}</strong>
	<strong>{{link_to('user/register', 'Sign-Up')}}</strong>
	<strong>{{link_to('user/password', 'Forgot Password')}}</strong>
</div>
@endif

@yield('content')

@yield('footer')