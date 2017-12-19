<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="https://eandscargo.com/images/logo.png">
		<title>{{ $title }}</title>
		{{ HTML::style('frameworks/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('plugins/fontawesome/font-awesome/css/font-awesome.min.css') }}
		{{ HTML::style('css/custom.css') }}
		{{ HTML::script('frameworks/jquery/jquery.min.js') }}
		{{ HTML::script('js/functions.js') }}

	</head>
	<body>
		<header>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ URL::to('/') }}">E & S Cargo</a>
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							@if(Auth::check())
							<li>
								<a href="#dhlSearch" data-toggle="modal">Busqueda por DHL</a>
							</li>
							{{ View::make('layouts.'.UserLib::getUserRole()->slug.'.menu') }}
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }} <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="{{ URL::to('administrador/ver-usuarios/'.Auth::id()) }}">
											<i class="fa fa-cogs"></i> Cambiar contraseña
										</a>
									</li>
									<li>
										<a href="{{ URL::to('cerrar-sesion') }}">
											<i class="fa fa-times"></i> Cerrar Sesión
										</a>
									</li>
								</ul>
							</li>
							@endif
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</header>
		<section class="content">
			@yield('content')
		</section>
		<footer  @if(!Auth::check()) class="auth" @endif>
			<div class="panel panel-default">
				<div class="panel-body"><p class="text-center"><i class="fa fa-copyright"></i> Todos los derechos reservados | Desarrollado por mi</p></div>
			</div>
		</footer>
		<div class="modal fade" id="dhlSearch">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Busqueda por DHL</h4>
					</div>
					<div class="modal-body">
						<div class="alert alert-info">
							<i class="fa fa-info-circle"></i> Ingrese los codigos de rastreo (maximo 10), separe los numeros con un (enter)
						</div>

						<textarea class="form-control dhl"></textarea>
					</div>
					<div class="modal-footer">
						<a href="" class="btn btn-primary btn-search-dhl" target="_blank">Buscar</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	{{ HTML::script('frameworks/bootstrap/js/bootstrap.min.js') }}
	{{ HTML::script('js/custom.js') }}
	@yield('postscript')


</html>