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
					<h3 class="text-center">Modificar paquete</h3>
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
					<form method="POST" action="{{ URL::to('administrador/ver-paquete/'.$package->id.'/enviar') }}">
						<div class="col-xs-12 col-md-6 input-field">
							<label>Tipo de envio (*)</label>
						  	<select class="form-control validate-input envio-type type" name="type" data-name="tipo de envio" data-target=".partial-container" data-url="{{ URL::to('administrador/cargar-campos') }}">
								<option value="">Seleccione una opción</option>
								@foreach($types as $t)
								<option value="{{ $t->id }}" @if($package->package_type == $t->id) selected @endif>{{ $t->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Remitente (*)</label>
						  	<select class="form-control validate-input selectpicker" name="shipper" data-name="remitente" data-show-subtext="true" data-live-search="true">
								<option value="">Seleccione una opción</option>
								@foreach($users as $u)
									<option value="{{ $u->id }}" @if($package->shipper_id == $u->id) selected @endif data-subtext="{{ $u->email }}">{{ ucfirst($u->username) }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Origen de la carga (*)</label>
							<input type="text" name="origin" class="form-control validate-input" placeholder="Origen de la carga (*)" data-name="Origen de la carga" value="{{ $package->origin }}">
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Destino de la carga (*)</label>
							<input type="text" name="destination" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ $package->destination }}">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Alto <small>pulg</small>(*)</label>
						  	<input type="number" name="height" class="form-control validate-input alto" placeholder="Alto" value="{{ $package->height }}" data-name="alto">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Ancho <small>pulg</small>(*)</label>
						  	<input type="number" name="width" class="form-control validate-input ancho" placeholder="Ancho" value="{{ $package->width }}" data-name="ancho">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Largo <small>pulg</small>(*)</label>
						  	<input type="number" name="length" class="form-control validate-input largo" placeholder="Largo" value="{{ $package->length }}" data-name="largo">
						</div>
						<div class="col-xs-12 input-field">
							<label>Peso <small>Lb</small>(*)</label>
						  	<input type="number" name="weight" class="form-control validate-input" placeholder="Peso" value="{{ $package->weight }}" data-name="peso">
						</div>
						<div class="col-xs-12 input-field">
							<label data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo">Volumen <small>pulg<sup>3</sup></small>(*)</label>
							<input type="text" class="form-control disabled volume" disabled placeholder="Volumen" data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo" value="{{ $package->volumen }}">
						</div>
						<input type="hidden" name="volume" class="volume" value="{{ $package->volumen }}">
						<div class="col-xs-12 input-field">
							<label data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo">Flete <span class="flete-tipo"></span>(*)</label>
							<input type="text" class="form-control disabled flete" disabled placeholder="Volumen" data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo" value="{{ $package->flete }}">
						</div>
						<input type="hidden" name="flete" class="flete" value="{{ $package->flete }}">
						<div class="col-xs-12 col-md-6 input-field">
							<label>Tipo de mercancia (*)</label>
							<input type="text" name="merc_type" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ $package->merc_type }}">
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Costo de la mercancia <small>USD</small>(*)</label>
							<input type="text" name="merc_value" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ $package->merc_value }}">
						</div>
						<div class="col-xs-12 input-field">
							<label>Ubicación (*)</label>
						  	<input type="text" name="location" class="form-control validate-input" placeholder="Ubicación" value="{{ $package->location }}" data-name="ubicación">
						</div>
						<div class="col-xs-12 input-field">
							<label>Cantidad de cajas (*)</label>
						  	<input type="number" name="box_qty" class="form-control validate-input" placeholder="Cantidad de cajas" value="{{ $package->box_qty }}" data-name="cantidad de cajas">
						</div>
						<div class="col-xs-12">
							<label>Consigna (*)</label>
							<input type="text" name="consig" class="form-control validate-input" placeholder="Consigna" value="{{ $package->consignee }}">
						</div>
						<div class="partial-container">
							@if($package->types->slug == 'puerta-a-puerta')
								<input type="hidden" class="input_old" name="dest" value="{{ $package->descs->dest }}"> 
								<input type="hidden" class="input_old" name="ref_no" value="{{ $package->descs->reference_number }}"> 
								<input type="hidden" class="input_old" name="carrier" value="{{ $package->descs->carrier }}"> 
								<input type="hidden" class="input_old" name="ship_mode" value="{{ $package->descs->ship_mode }}">
							@elseif($package->types->slug == 'aereos')
								<input type="hidden" class="input_old" name="charge_type" value="{{ $package->descs->charge_type }}">
								<input type="hidden" class="input_old" name="airport_depart" value="{{ $package->descs->airport_depart }}">
								<input type="hidden" class="input_old" name="airport_dest" value="{{ $package->descs->airport_dest }}">
							@elseif($package->types->slug == 'maritimos')
								<input type="hidden" class="input_old" name="notify_party" value="{{ $package->descs->notify_party }}">
								<input type="hidden" class="input_old" name="export_instructions" value="{{ $package->descs->export_instructions }}">
								<input type="hidden" class="input_old" name="place_of_reception" value="{{ $package->descs->place_of_reception }}">
								<input type="hidden" class="input_old" name="shop_line" value="{{ $package->descs->shop_line }}">
								<input type="hidden" class="input_old" name="port_of_loading" value="{{ $package->descs->port_of_loading }}">
								<input type="hidden" class="input_old" name="place_of_deliver" value="{{ $package->descs->place_of_deliver }}">
							@endif
						</div>
						<div class="col-xs-12 input-field">
							<label>Observación</label>
						  	<textarea name="observation" class="form-control" placeholder="Observación" data-name="observación">{{ $package->observation }}</textarea>
						</div>
						{{ Form::token() }}
						<input type="hidden" name="pack_id" value="{{ $package->id }}">
					</form>
					<div class="col-xs-12 input-field">
						<button class="btn btn-success pull-right btn-submit">Enviar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('postscript')
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var btn = $('.type');
	    var dataPost = {};
	    dataPost['id'] = btn.val();

	    $('.input_old').each(function(index, el) {
	    	console.log($(el).attr('name'));
	      dataPost[$(el).attr('name')] = $(el).val();      
	    });

	    doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, beforeSelectLoad, successSelectLoad, endSelectLoadAjax);
	});
</script>
@stop