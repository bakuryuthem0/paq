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
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Ciudad</th>
								<th>Estado</th>
								<th>Codigo Zip</th>
								<th>Telefono</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							@foreach($shippers as $s)
							<tr>
								<td>{{ $s->id }}</td>
								<td>
									@if(empty($s->name))
										Sin especificar
									@else
										{{ $s->name }}
									@endif
								</td>
								<td>
									@if(empty($s->address))
										Sin especificar
									@else
										{{ $s->address }}
									@endif	
								</td>
								<td>
									@if(empty($s->city))
										Sin especificar
									@else
										{{ $s->city }}
									@endif
								</td>
								<td>
									@if(empty($s->state))
										Sin especificar
									@else
										{{ $s->state }}
									@endif
								</td>
								<td>
									@if(empty($s->zip))
										Sin especificar
									@else
										{{ $s->zip }}
									@endif
								</td>
								<td>
									@if(empty($s->phone))
										Sin especificar
									@else
										{{ $s->phone }}
									@endif
								</td>
								<td>
									<a href="{{ URL::to('administrador/ver-remitentes/'.$s->id) }}" class="btn btn-warning btn-xs">
										Editar
									</a>
								</td>
								<td>
									<button class="btn btn-xs btn-danger btn-elim-shipper" data-toggle="modal" data-target="#modalElim" data-url="{{ URL::to('administrador/ver-remitentes/eliminar') }}" value="{{ $s->id }}" data-tosend="id">Eliminar</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{ View::make('partials.pagination')->with('collection',$shippers)->with('busq',$busq) }}
			</div>
		</div>
	</div>
</div>
{{ View::make('partials.modalElim') }}
@stop
