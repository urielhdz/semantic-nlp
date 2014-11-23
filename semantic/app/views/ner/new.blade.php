@extends('layouts.application')
@section('content')
	<div class="be-gray large-padding blue col-md-8 no-float center-block">
		<h1>
			Name Entity Recognition
		</h1>
		<form action="{{(url('/'))}}/relate", method="get">
			<div class="form-group">
				<label>
					Ingresa el texto a convertir
				</label>
				<textarea name="data" id="data" class="form-control" style="height:350px;">President Obama called Wednesday on Congress to extend a tax break
  for students included in last year's economic stimulus package, arguing
  that the policy provides more generous assistance.</textarea>
			</div>
			<div class="form-group">
				<label>
					¿Qué deseas hacer?
				</label>
				<select class="form-control" id="change_options">
					<option value="{{(url('/'))}}/relate">
						Definir relaciones
					</option>
					<option value="{{(url('/'))}}/look">
						Resaltar Entidades
					</option>
					
				</select>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-danger btn-lg" value="Convertir">
			</div>
			
		</form>
	</div>
	<script>
		$("#change_options").on("change",function(e){
			console.log($(this).val());
			$(this).parent().parent().attr("action",$(this).val());
		});
	</script>
@stop