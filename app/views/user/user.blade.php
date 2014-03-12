<h2>Welcome to featherQ!</h2>
<h3>Save time because time flies by!</h3>

@yield('title')

@if(Session::has('message'))
	<div class="alert alert-success">
		{{Session::get('message')}}
	</div>
@endif

@if(Session::has('error'))
	<div class="alert alert-warning">
		{{Session::get('error')}}
	</div>	
@endif

@if (!Auth::check())
<div>
	<strong>{{link_to('user/login', 'Login')}}</strong>
	<strong>{{link_to('user/register', 'Sign-Up')}}</strong>
	<strong>{{link_to('user/password', 'Forgot Password')}}</strong>
</div>
@endif

@yield('content')

@yield('footer')