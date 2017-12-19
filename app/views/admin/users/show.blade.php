@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-11 center-block">
		<div class="panel panel-default login-panel">
			<div class="panel-heading">
				<h3 class="text-center">Ver Usuarios</h3>
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
						<input type="text" class="form-control" name="busq" placeholder="Busqueda: Id o Username" value="{{ $busq }}">
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
								<th>Usuario</th>
								<th>Rol / Permisos</th>
								<th>Cambiar Rol / Permisos</th>
								<th>Modificar</th>
								<th>Eliminar</th>

							</tr>
						</thead>
						<tbody>
							@foreach($users as $u)
							<tr>
								<td>{{ $u->id }}</td>
								<td>{{ $u->full_name }}</td>
								<td>{{ $u->username }}</td>
								<td>{{ $u->roles->description }}</td>
								<td>
									<button class="btn btn-primary btn-xs change-role" data-toggle="modal" data-target="#changeRole" value="{{ $u->id }}">Cambiar</button>
								</td>
								<td><a target="_blank" href="{{ URL::to('administrador/ver-usuarios/'.$u->id) }}" class="btn btn-xs btn-warning">Cambiar Contraseña</a></td>
								<td><button class="btn btn-xs btn-danger btn-elim-user" data-toggle="modal" data-target="#modalElim" data-url="{{ URL::to('administrador/ver-usuarios/eliminar') }}" value="{{ $u->id }}" data-tosend="id">Eliminar</button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ View::make('partials.pagination')->with('collection',$users)->with('busq',$busq) }}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="changeRole">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar Rol</h4>
			</div>
			<div class="modal-body">
				<div class="alert responseAjax">
		          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		          <p></p>
		        </div>
				<label>Roles</label>
				<select class="form-control sel-change-role">
					<option value="">Seleccione una opción...</option>
					@foreach($roles as $r)
						<option value="{{ $r->id }}">{{ $r->description }}</option>
					@endforeach
				</select>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-primary btn-change-role" data-url="{{ URL::to('administrador/ver-usuario/cambiar-rol') }}" data-target=".sel-change-role">Enviar</button>
			</div>
		</div>
	</div>
</div>
{{ Form::token() }}
{{ View::make('partials.modalElim') }}
@stop
