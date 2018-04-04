<thead>
	<tr>
		<th>Proveedor</th>
		<th>Telefono Proveedor</th>
	@if($package->types->slug =="puerta-a-puerta")
		<th>Carrier</th>
		<th>Destino</th>
		<th>Numero de referencia</th>
		<th>Modo de envio</th>
	@elseif($package->types->slug =="aereos")
		<th>Tipo de carga</th>
		<th>Aeropuerto de salida</th>
		<th>Aeropuerto de destino</th>
	@elseif($package->types->slug =="maritimos")
		<th>A notificar</th>
		<th>Instrucciones de exportación</th>
		<th>Lugar de recepción</th>
		<th>Tienda</th>
		<th>Puerto de carga</th>
		<th>Lugar de entrega</th>
	@endif
	</tr>
</thead>
<tbody>
	<tr>
		<td>
		@if(empty($package->providers))
			Sin especificar
		@else
			{{ $package->providers->name }}
		@endif
		</td>
		<td>
			{{ empty($package->provider_phone) ? "Sin especificar" : $package->provider_phone }}
		</td>
		@if($package->types->slug =="puerta-a-puerta")
		<td>{{ $package->descs->carrier }}</td>
		<td>{{ $package->descs->dest }}</td>
		<td>
			@if(empty($package->descs->reference_number))
				Sin especificar
			@else
				{{ $package->descs->reference_number }}
			@endif
		</td>
		<td>{{ $package->descs->ship_mode }}</td>
		@elseif($package->types->slug =="aereos")
			<td>{{ $package->descs->charge_type }}</td>
			<td>{{ $package->descs->airport_depart }}</td>
			<td>{{ $package->descs->airport_dest }}</td>
		@elseif($package->types->slug =="maritimos")
			@if(empty($package->descs->notify_party))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->notify_party }}</td>
			@endif
			@if(empty($package->descs->export_instructions))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->export_instructions }}</td>
			@endif
			@if(empty($package->descs->place_of_reception))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->place_of_reception }}</td>
			@endif
			@if(empty($package->descs->shop_line))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->shop_line }}</td>
			@endif
			@if(empty($package->descs->port_of_loading))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->port_of_loading }}</td>
			@endif
			@if(empty($package->descs->place_of_deliver))
				<td>Sin especificar</td>
			@else
				<td>{{ $package->descs->place_of_deliver }}</td>
			@endif
		@endif
	</tr>
</tbody>