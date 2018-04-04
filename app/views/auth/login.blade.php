@extends('layouts.default')

@section('content')
	<div class="valign-pane col-sm-12 col-md-6">
		<div class="col-xs-12">
			<h2 class="text-center">Sistema de Administración</h2>
		</div>
		<div class="clearfix"></div>
		<div class="center-block">
			<div class="panel panel-default login-panel">
				<div class="panel-heading">
					<h3 class="text-center">Inicio de sesión</h3>
				</div>
				<div class="panel-body">
					@if(Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif
					@if(Session::has('danger'))
						<div class="alert alert-danger">
							{{ Session::get('danger') }}
						</div>
					@endif
					@if(count($errors->getMessageBag()) > 0)
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Error, usuario o contraseña incorrectos.
						</ul>
					</div>
					@endif
					<form method="POST" action="{{ URL::to('login/enviar') }}">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon-user"><i class="fa fa-user"></i></span>
						  <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon-user">
						</div>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon-password"><i class="fa fa-lock"></i></span>
						  <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon-password">
						</div>
						<div class="input-field">
							<a href="#recoverPassword" class="pull-left" data-toggle="modal">Recuperar Contraseña</a>
							<button class="btn btn-success btn-submit pull-right">Enviar</button>
						</div>
						{{ Form::token() }}
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="recoverPassword">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Recuperar contraseña</h4>
				</div>
				<div class="modal-body">
					<div class="alert responseAjax">
			          <p></p>
			        </div>
			        <div class="alert alert-info">
			        	<i class="fa fa-info-circle"></i> Ingrese su email y le enviaremos un enlace con el que podra recuperar su contraseña
			        </div>
					<label>Email</label>
					<input type="email" name="email" class="form-control email">
				</div>
				<div class="modal-footer">
					<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
					<button type="button" class="btn btn-primary btn-recover-pass" data-url="{{ URL::to('recuperar-password') }}" data-target=".email">Enviar</button>
				</div>
			</div>
		</div>
	</div>
@stop