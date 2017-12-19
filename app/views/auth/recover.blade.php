@extends('layouts.default')

@section('content')
	<div class="">
		<div class="col-xs-12">
			<h2 class="text-center"></h2>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-8 col-md-6 center-block">
			<div class="panel panel-default login-panel">
				<div class="panel-heading">
					<h3 class="text-center">Recuperar contraseña</h3>
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
					<form method="POST" action="{{ URL::to('recuperar-password/'.$hash.'/enviar') }}">
						<div class="input-field">
							<label>Contraseña (*)</label>
						  	<input type="password" name="password" class="form-control validate-input" placeholder="Contraseña" value="{{ Input::old('password') }}">
						</div>
						<div class="input-field">
							<label>Repita la Contraseña (*)</label>
						  	<input type="password" name="password_confirmation" class="form-control validate-input" placeholder="Contraseña" value="{{ Input::old('password_confirmation') }}">
						</div>
						<input type="hidden" name="user_id" value="{{ $id }}">
						{{ Form::token() }}
					</form>
					<div class="input-field">
						<button class="btn btn-success pull-right btn-submit">Enviar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop