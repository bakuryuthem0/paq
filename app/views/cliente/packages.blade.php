@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-11 center-block">
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
				<div class="col-xs-12 col-md-4 pull-right">
					<form method="GET" action="{{ Request::url() }}">
					<div class="input-group">
						<input type="text" class="form-control" name="busq" placeholder="Busqueda: Id" value="{{ $busq }}">
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
								<th>Guia</th>
								<th>Dimensiones</th>
								<th>Ubicación</th>
								<th>Observación</th>
								<th>Cantidad de cajas</th>
								<th>Status</th>
								<th>Ubicación</th>
								<th>Características adicionales</th>
							</tr>
						</thead>
						<tbody>
							@foreach($packages as $p)
							<?php $aero = UserLib::checkAeroline(substr($p->guide_number,0,3));?>
							<tr>
								<td>{{ $p->id }}</td>
								<td>
									@if($aero)
									<a href="{{ $aero->url.'?'.$aero->variable_name.'='.$p->guide_number }}" title="{{ $aero->name }}" target="_blank">
										{{ $p->guide_number }}
										
									</a>
									@else
									{{ $p->guide_number }}
									@endif
								</td>
								<td>
									<button class="btn btn-info btn-xs btn-flat" data-toggle="collapse" data-target="#collapse_{{ $p->id }}">Ver</button>
									<ul class="text-left collapse" id="collapse_{{ $p->id }}">
										<li><strong>Peso:</strong> {{ number_format($p->weight, 2, ',', '.') }}Lbs</li>
										<li><strong>Ancho:</strong> {{ $p->width }}</li>
										<li><strong>Alto:</strong> {{ $p->height }}</li>
										<li><strong>Largo:</strong> {{ $p->length }}</li>
										<li><strong>Volumen: </strong> {{ $p->volumen }}</li>
										<li><strong>Flete: </strong> {{ number_format($p->flete, 4) }}</li>

									</ul>
								</td>
								<td>{{ $p->location }}</td>
								<td>
									@if(!empty($p->observation))
										{{ $p->observation }}
									@else 
										Sin observación 
									@endif
								</td>
								<td>{{ $p->box_qty }}</td>
								<td>
									@if($p->status->slug == "entregado")
										<i class="text-success fa fa-check"></i><span class="text-success">
									@elseif($p->status->slug == "procesando")
										<i class="text-primary fa fa-clock-o"></i><span class="text-primary">
									@elseif($p->status->slug == "en-camino")
										<i class="text-warning fa fa-truck"></i><span class="text-warning">
									@elseif($p->status->slug == "devuelto")
										<i class="text-danger fa fa-times"></i><span class="text-danger">
									@endif
									{{ $p->status->description }}</p>
								</td>
								<td>
									<button class="btn btn-primary btn-xs show-location" data-toggle="modal" data-target="#locations" data-toload=".partial-container" data-url="{{ URL::to('administrador/ver-ubicacion') }}" value="{{ $p->id }}">Ver</button>
								</td>
								<td>
									<button class="btn btn-default btn-xs see-extra-details" data-toggle="modal" data-target="#seeDetails" value="{{ $p->id }}" data-url="{{ URL::to('administrador/ver-caracteristicas') }}">Ver</button>
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
<div class="modal fade" id="locations">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Ver ubicación</h4>
			</div>
			<div class="modal-body partial-container">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="seeDetails">
	<div class="modal-dialog modal-lg">
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
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{ Form::token() }}
@stop
