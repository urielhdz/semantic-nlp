@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-8 no-float center-block">
		<h1>
			Name Entity Recognition Crawler
		</h1>
		<form action="{{(url('/'))}}/crawl", method="get">
			<div class="form-group">
				<label for="url">
					Ingresa la URL a evaluar
				</label>
				<input type="url" autofocus required placeholder="http://..." name="url" id="url" class="form-control">
			</div>
			<div class="form-group">
				<label for="depth">
					Profundidad <span style="font-size:10px;">(niveles de profundidad que el crawler visitará)</span>: 
				</label>
				<input type="number" required value="2" max="3" min="1" name="depth" id="depth" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-danger btn-lg" value="Convertir">
			</div>
			
		</form>
	</div>
@stop