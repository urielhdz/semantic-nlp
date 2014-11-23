@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-9 no-float center-block">
		<h1>
			{{str_replace("page","data", $sentence->subject_url);}}
		</h1>
		<pre>
			{{$dbpedia_data}}
		</pre>
	</div>
@stop