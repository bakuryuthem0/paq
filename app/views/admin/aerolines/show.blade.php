@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12 center-block">
		<div class="panel panel-default login-panel">
			<div class="panel-heading">
				<h3 class="text-center">Gestionar Aerolineas</h3>
			</div>
			<div class="panel-body">
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
				<form action="{{ URL::to('administrador/nueva-aerolinea/enviar') }}" method="POST" accept-charset="utf-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Nueva aerolinea</h3>
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
							<input type="text" name="name" class="form-control" value="{{ Input::old('name') }}">
						</div>
						<div class="input-field">
							<label>Código</label>
							<input type="text" name="code" class="form-control" value="{{ Input::old('code') }}">
						</div>
						<div class="input-field">
							<label>URL</label>
							<input type="text" name="url" class="form-control" value="{{ Input::old('url') }}">
						</div>
						<div class="input-field">
							<div class="alert alert-info">
								<i class="fa fa-info-circle"></i> Para saber cual es la variable a ingresar, dirijase a la pagina web  de la aerolinea y realize la busqueda con un código, una vez realizada copiamos el URL que posea la parte del código que acabamos de buscar. 
								<br>
								<br>
								<strong>Ejemplo</strong>: Para DHL, realizamos la busqueda  del código <strong>35100000000</strong>, el URL se mostraria como a continuación <pre>http://www.dhl.com.ve/es/express/rastreo.html?<strong>AWB=35100000000</strong>&brand=DHL</pre> observamos que la variable que contiene nuestro código de guia es "AWB", eso es lo que escribiremos en el campo variable.
							</div>
							<label>Variable</label>
							<input type="text" name="var" class="form-control" value="{{ Input::old('var') }}">
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-success btn-flat" type="submit">Enviar</button>
					</div>
				</div>
				</form>
				<br>
				<br>
				<div class="col-sm-12 text-center">
					<h3 class="text-center">Ver Aerolineas</h3>
				</div>
				@if($busq != "")
				<div class="col-xs-4 col-md-8 pull-left">
					<a href="{{ Request::url() }}" class="btn btn-warning">Restaurar</a>
				</div>
				@endif
				<div class="col-xs-8 col-md-4 pull-right">
					<form method="GET" action="{{ Request::url() }}">
					<div class="input-group">
						<input type="text" class="form-control" name="busq" placeholder="Busqueda: Código" value="{{ $busq }}">
					    <span class="input-group-btn">
					        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					    </span>
					</div><!-- /input-group -->
					</form>
				</div>
				<div class="clearfix"></div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th data-toggle="tooltip" data-placement="top" data-content="Nombre de la aerolinea">Nombre</th>
								<th data-toggle="tooltip" data-placement="top" data-content="Código que usara el sistema para buscar la aerolinea">Código</th>
								<th data-toggle="tooltip" data-placement="top" data-content="URL de la aerolinea donde se realizara la busqueda">URL</th>
								<th data-toggle="tooltip" data-placement="top" data-content="Variable que utiliza la aerolinea para realizar la busqueda">Variable</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($aerolines as $a)
							<tr>
								<td>{{ $a->id }}</td>
								<td>{{ $a->name }}</td>
								<td>{{ $a->code }}</td>
								<td>{{ $a->url }}</td>
								<td>{{ $a->variable_name }}</td>
								<td><a href="{{ URL::to('administrador/ver-aerolineas/'.$a->id) }}" class="btn btn-warning btn-xs btn-flat">Editar</a></td>
								<td><button class="btn btn-danger btn-xs btn-flat btn-elim-this" data-toggle="modal" data-target="#modalElim" data-url="{{ URL::to('administrador/ver-aerolineas/eliminar') }}" value="{{ $a->id }}" data-tosend="id">Eliminar</button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@include('partials.pagination',['collection' => $aerolines,'busq' => $busq])

			</div>
		</div>
	</div>
</div>
{{ View::make('partials.modalElim') }}
@stop
