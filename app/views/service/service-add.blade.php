@section('content')

<h3>Add Services</h3>

<div>
{{ Form::open(array('url' => 'service/create')) }}
	{{ Form::text('service_name', null, array('class'=>'input-block-level', 'placeholder'=>'Service Name')) }}
	{{ Form::submit('CREATE') }}
{{ Form::close() }}
<div>

@stop