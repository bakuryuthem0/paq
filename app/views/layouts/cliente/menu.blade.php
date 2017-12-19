<li>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Paquetes <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li>
			<a href="{{ URL::to('administrador/ver-paquetes/entregados') }}">
				<i class="fa fa-handshake-o"></i> Ver paquetes entregados
			</a>
		</li>
		<li>
			<a href="{{ URL::to('administrador/ver-paquetes/no-entregados') }}">
				<i class="fa fa-truck"></i> Ver paquetes por entregar 
			</a>
		</li>
		<li>
			<a href="{{ URL::to('administrador/ver-paquetes/todos') }}">
				<i class="fa fa-list"></i> Ver todos los paquetes
			</a>
		</li>
	</ul>
</li>