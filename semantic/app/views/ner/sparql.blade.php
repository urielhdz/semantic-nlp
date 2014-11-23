@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-8 no-float center-block">
		<h1>SPARQL 4store endpoint</h1>
		<form action="{{(url('/'))}}/query">
			<div class="form-group">
				<label for="query">Sparql Query</label>
				<textarea class="form-control" name="query" id="query" style="height:400px"></textarea>	
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-danger btn-lg" value="Query">
			</div>
		</form>
	</div>
	
@stop