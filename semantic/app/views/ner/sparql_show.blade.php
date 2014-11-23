@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-9 no-float center-block">
		<h1>SPARQL result</h1>
		<h2>Query</h2>
		<pre>{{$query}}</pre>
		<h2>Result</h2>
		<div style="margin-top:1em;">
			<table class="table table-striped">
			  <thead>
			  	<td>Subject</td>
			  	<td>Predicate</td>
			  	<td>Object</td>
			  	
			  </thead>
			  <tbody>
			  	@foreach($response as $row)
			  		<tr>
			  			<td>
			  				{{$row["s"]}}
			  			</td>
			  			<td>
			  				{{$row["p"]}}
			  			</td>
			  			<td>
			  				{{$row["o"]}}
			  			</td>
			  			
			  		</tr>
			  	@endforeach
			  </tbody>
			</table>
			
		</div>
	</div>
@stop