<li>
	<a href="{{ URL::to('administrador/ver-aerolineas') }}">Gestionar Aerolineas</a>
</li>
<li>
	<a href="{{ URL::to('administrador/ver-proveedores') }}">Gestionar Proveedores</a>
</li>
<li>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Paquetes <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li>
			<a href="{{ URL::to('administrador/nuevo-paquete') }}">
				<i class="fa fa-plus"></i> Nuevo Paquete
			</a>
		</li>
		<li>
			<a href="{{ URL::to('administrador/ver-paquetes') }}">
				<i class="fa fa-list"></i> Ver Paquetes
			</a>
		</li>
	</ul>
</li>
<li>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li>
			<a href="{{ URL::to('administrador/nuevo-usuario') }}">
				<i class="fa fa-plus"></i> Nuevo Usuario
			</a>
		</li>
		<li>
			<a href="{{ URL::to('administrador/ver-usuarios') }}">
				<i class="fa fa-list"></i> Ver Usuarios
			</a>
		</li>
	</ul>
</li>