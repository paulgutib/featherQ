@section('content')

<h3>Add Terminals</h3>

<div>
		{{ Form::open(array('url' => 'terminal/create-type')) }}
		<div>
			<h3>ADD TERMINAL TYPE</h3>
		  {{ Form::text('type_name', null, array('class'=>'input-block-level', 'placeholder'=>'Terminal Type Name')) }}
		  {{ Form::submit('ADD') }}
		</div>
		{{ Form::close() }}
		{{ Form::open(array('url' => 'terminal/create-node')) }}
		<div>
			<h3>ADD TERMINAL NODE</h3>
		  {{ Form::text('node_name', null, array('class'=>'input-block-level', 'placeholder'=>'Terminal Node Name')) }}
		  {{ Form::select('type_list', $types) }}
		  {{ Form::submit('ADD') }}
		</div>
		{{ Form::close() }}
  </div>

@stop