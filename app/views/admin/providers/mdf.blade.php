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
		<form action="{{ URL::to('administrador/ver-proveedores/'.$provider->id.'/enviar') }}" method="POST" accept-charset="utf-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Modificar Proveedor</h3>
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
						<label>Nombre del proveedor (*)</label>
						<input type="text" name="name" class="form-control" value="{{ $provider->name }}">
					</div>
					<div class="input-field">
						<label>Código</label>
						<input type="text" name="code" class="form-control" value="{{ $provider->code }}">
					</div>
					<div class="input-field">
						<label>Telefono</label>
						<input type="text" name="phone" class="form-control" value="{{ $provider->phone }}">
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-success btn-flat" type="submit">Enviar</button>

					<small class="pull-right">(*) campo obligatorio</small>
				</div>
			</div>
		</form>

	</div>
</div>
{{ View::make('partials.modalElim') }}
@stop
