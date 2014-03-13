@extends('user.user')

@section('title')
<strong>{{link_to('user/logout', 'Log Out')}}</strong>

<h2>Welcome, {{{Auth::user()->username}}}!</h2>
<h3>DASHBOARD</h3>
@stop