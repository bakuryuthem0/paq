@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12 center-block">
		<div class="panel panel-default login-panel">
			<div class="panel-heading">
				<h3 class="text-center">Ver paquetes</h3>
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
				@if($busq != "")
				<div class="col-xs-4 col-md-8 pull-left">
					<a href="{{ Request::url() }}" class="btn btn-warning">Restaurar</a>
				</div>
				@endif
				<div class="col-xs-8 col-md-4 pull-right">
					<form method="GET" action="{{ Request::url() }}">
					<div class="input-group">
						<input type="text" class="form-control" name="busq" placeholder="Busqueda: Id o username" value="{{ $busq }}">
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
								<th>Usuario</th>
								<th>Emisor</th>
								<th>Peso (Kg)</th>
								<th>Peso (Lbs)</th>
								<th>Ubicación</th>
								<th>Observación</th>
								<th>Cantidad de cajas</th>
								<th>Status</th>
								<th>Características adicionales</th>
								<th>Editar</th>
								<th>Cambiar ubicación</th>
								<th>Cambiar status</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($packages as $p)
							<tr>
								<td>{{ $p->id }}</td>
								<td>{{ $p->user->username }}</td>
								<td>{{ $p->shipper }}</td>
								<td>{{ number_format($p->weight,2,',','.') }}Kg</td>
								<td>
									{{ number_format($p->weight*2.20, 2, ',', '.') }}Lbs</td>
								<td>{{ $p->location }}</td>
								<td>
									@if(!empty($p->observation))
										{{ $p->observation }}
									@else 
										Sin observación 
									@endif
								</td>
								<td>{{ $p->box_qty }}</td>
								<td>{{ $p->status->description }}</td>
								<td>
									<button class="btn btn-default btn-xs see-extra-details" data-toggle="modal" data-target="#seeDetails" value="{{ $p->id }}" data-url="{{ URL::to('administrador/ver-caracteristicas') }}">Ver</button>
								</td>
								<td>
									<a href="{{ URL::to('administrador/ver-paquetes/'.$p->id) }}" class="btn btn-warning btn-xs">
										Editar
									</a>
								</td>
								<td>
									<button class="btn btn-info btn-xs change-role" data-toggle="modal" data-target="#changeLocation" value="{{ $p->id }}">Cambiar ubicación</button>
								</td>
								<td>
									<button class="btn btn-primary btn-xs change-role" data-toggle="modal" data-target="#changeRole" value="{{ $p->id }}">Cambiar status</button>
								</td>
								<td>
									<button class="btn btn-xs btn-danger btn-elim-package" data-toggle="modal" data-target="#modalElim" data-url="{{ URL::to('administrador/ver-paquetes/eliminar') }}" value="{{ $p->id }}" data-tosend="id">Eliminar</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{ View::make('partials.pagination')->with('collection',$packages)->with('busq',$busq) }}
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="seeDetails">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Ver datos adicionales</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover respone-desc">
						
					</table>
				</div>
				<div class="text-center center-block">
					<img src="{{ asset('images/loader.gif') }}" class="miniLoader active">
				</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="changeLocation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar Ubicación</h4>
			</div>
			<div class="modal-body">
				<div class="alert responseAjax">
		          <p></p>
		        </div>
				<label>Ubicación</label>
				<input type="text" name="location" class="form-control location">
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-primary btn-change-role" data-url="{{ URL::to('administrador/ver-paquetes/cambiar-ubicacion') }}" data-target=".location">Enviar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="changeRole">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar Status</h4>
			</div>
			<div class="modal-body">
				<div class="alert responseAjax">
		          <p></p>
		        </div>
				<label>Status</label>
				<select class="form-control sel-change-role">
					<option value="">Seleccione una opción...</option>
					@foreach($status as $s)
						<option value="{{ $s->id }}">{{ $s->description }}</option>
					@endforeach
				</select>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-primary btn-change-role" data-url="{{ URL::to('administrador/ver-paquetes/cambiar-status') }}" data-target=".sel-change-role">Enviar</button>
			</div>
		</div>
	</div>
</div>
{{ Form::token() }}
{{ View::make('partials.modalElim') }}
@stop
