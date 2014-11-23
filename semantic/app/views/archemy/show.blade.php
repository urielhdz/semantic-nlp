@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-9 no-float center-block">
		<h1>Relations parser</h1>
		<h3>Text</h3>
		<pre>{{$data}}</pre>
		<h3>Relations</h3>
		<div style="margin-top:1em;">
			<table class="table table-striped">
			  <thead>
			  	<td>Subject</td>
			  	<td>Action</td>
			  	<td>Object</td>
			  	<td>Location</td>
			  	<td>Actions</td>
			  </thead>
			  <tbody>
			  	@foreach($relations as $relation)
			  		<tr>
			  			<td>
			  				@if($relation->subject_url)
			  				<a href="{{$relation->subject_url}}" target="_blank">
			  					{{$relation->subject}}
			  				</a>
			  				@else
			  					{{$relation->subject}}
			  				@endif
			  			</td>
			  			<td>
			  				{{$relation->action}}
			  			</td>
			  			<td>
			  				@if($relation->object_url)
			  				<a href="{{$relation->object_url}}" target="_blank">
			  					{{$relation->object}}
			  				</a>
			  				@else
			  					{{$relation->object}}
			  				@endif
			  			</td>
			  			<td>
			  				@if($relation->location_url)
			  				<a href="{{$relation->location_url}}" target="_blank">
			  					{{$relation->location}}
			  				</a>
			  				@else
			  					{{$relation->location}}
			  				@endif
			  			</td>
			  			<td>
			  				@if($relation->subject_url)
			  				<a href="{{(url('/'))}}/dbpedia/{{$relation->id}}" target="_blank">
			  					DBPedia data
			  				</a>
			  				@endif
			  			</td>
			  		</tr>
			  	@endforeach
			  </tbody>
			</table>
			
		</div>
		<h3>Api Output</h3>
		<div style="margin-top:1em;">
			<pre>{{$response}}</pre>
		</div>
	</div>
@stop