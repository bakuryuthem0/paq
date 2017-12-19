@extends('layouts.default')

@section('content')
	<div class="">
		<div class="col-xs-12">
			<h2 class="text-center"></h2>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-10 center-block">
			<div class="panel panel-default login-panel">
				<div class="panel-heading">
					<h3 class="text-center">Modificar remitente</h3>
				</div>
				<div class="panel-body">
					@if(count($errors->getMessageBag()) > 0)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							@foreach($errors->all() as $err)
			                    <li>{{ $err }}</li>
			                @endforeach
						</ul>
					</div>
					@endif
					@if(Session::has('success'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ Session::get('success') }}
					</div>
					@endif
					<form method="POST" action="{{ URL::to('administrador/ver-remitente/'.$shipper->id.'/enviar') }}">
						<div class="col-xs-12">
							<label>Nombre/Alias</label>
							<input type="text" name="name" class="form-control" value="{{ $shipper->name }}" placeholder="Nombre/Alias">
						</div>
						<div class="col-xs-12">
							<label>Dirección</label>
							<textarea name="address" class="form-control" placeholder="Dirección">{{ $shipper->address }}</textarea>
						</div>
						<div class="col-xs-12">
							<label>Ciudad</label>
							<input type="text" name="city" class="form-control" value="{{ $shipper->city }}" placeholder="Ciudad">
						</div>
						<div class="col-xs-12">
							<label>Estado</label>
							<input type="text" name="state" class="form-control" value="{{ $shipper->state }}" placeholder="Estado">
						</div>
						<div class="col-xs-12">
							<label>Codigo Zip</label>
							<input type="text" name="code" class="form-control" value="{{ $shipper->zip }}" placeholder="Codigo Zip">
						</div>
						<div class="col-xs-12">
							<label>Telefono</label>
							<input type="text" name="phone" class="form-control" value="{{ $shipper->phone }}" placeholder="Telefono">
						</div>
						{{ Form::token() }}
					</form>
					<div class="col-xs-12 input-field">
						<button class="btn btn-success pull-right btn-submit">Enviar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop