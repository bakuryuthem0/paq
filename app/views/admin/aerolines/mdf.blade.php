@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12 center-block">
		@if(Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('success') }}
		</div>
		@endif
		@if(Session::has('danger'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('danger') }}
		</div>
		@endif
		<form action="{{ URL::to('administrador/ver-aerolineas/'.$aeroline->id.'/enviar') }}" method="POST" accept-charset="utf-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modificar aerolinea</h3>
				</div>
				<div class="panel-body">
					@if(count($errors->all()) > 0)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							@foreach($errors->all() as $err)
			                    <li>{{ $err }}</li>
			                @endforeach
						</ul>
					</div>
					@endif
					<div class="input-field">
						<label>Nombre de la aerolinea</label>
						<input type="text" name="name" class="form-control" value="{{ $aeroline->name }}">
					</div>
					<div class="input-field">
						<label>Código</label>
						<input type="text" name="code" class="form-control" value="{{ $aeroline->code }}">
					</div>
					<div class="input-field">
						<label>URL</label>
						<input type="text" name="url" class="form-control" value="{{ $aeroline->url }}">
					</div>
					<div class="input-field">
						<div class="alert alert-info">
							<i class="fa fa-info-circle"></i> Para saber cual es la variable a ingresar, dirijase a la pagina web  de la aerolinea y realize la busqueda con un código, una vez realizada copiamos el URL que posea la parte del código que acabamos de buscar. 
							<br>
							<br>
							<strong>Ejemplo</strong>: Para DHL, realizamos la busqueda  del código <strong>35100000000</strong>, el URL se mostraria como a continuación <pre>http://www.dhl.com.ve/es/express/rastreo.html?<strong>AWB=35100000000</strong>&brand=DHL</pre> observamos que la variable que contiene nuestro código de guia es "AWB", eso es lo que escribiremos en el campo variable.
						</div>
						<label>Variable</label>
						<input type="text" name="var" class="form-control" value="{{ $aeroline->variable_name }}">
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-success btn-flat" type="submit">Enviar</button>
				</div>
			</div>
		</form>

	</div>
</div>
{{ View::make('partials.modalElim') }}
@stop
