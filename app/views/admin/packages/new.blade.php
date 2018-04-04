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
					<h3 class="text-center">Nuevo paquete</h3>
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
					<form method="POST" action="{{ URL::to('administrador/nuevo-paquete/enviar') }}">
						<div class="col-xs-12 col-md-6 input-field">
							<label>Tipo de envio (*)</label>
						  	<select class="form-control validate-input envio-type type" name="type" data-name="tipo de envio" data-target=".partial-container" data-url="{{ URL::to('administrador/cargar-campos') }}">
								<option value="">Seleccione una opción</option>
								@foreach($types as $t)
								<option value="{{ $t->id }}" @if(Input::old('type') && Input::old('type') == $t->id) selected @endif>{{ $t->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Remitente (*)</label>
						  	<select class="form-control validate-input selectpicker" name="shipper" data-name="remitente" data-show-subtext="true" data-live-search="true">
								<option value="">Seleccione una opción</option>
								@foreach($users as $u)
									<option value="{{ $u->id }}" @if(Input::old('user') && Input::old('user') == $u->id) selected @endif data-subtext="{{ $u->email }}">{{ ucfirst($u->username) }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Origen de la carga (*)</label>
							<input type="text" name="origin" class="form-control validate-input" placeholder="Origen de la carga (*)" data-name="Origen de la carga" value="{{ Input::old('origin') }}">
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Destino de la carga (*)</label>
							<input type="text" name="destination" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ Input::old('destination') }}">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Alto <small>pulg</small>(*)</label>
						  	<input type="number" name="height" class="form-control validate-input alto" placeholder="Alto" value="{{ Input::old('height') }}" data-name="alto">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Ancho <small>pulg</small>(*)</label>
						  	<input type="number" name="width" class="form-control validate-input ancho" placeholder="Ancho" value="{{ Input::old('width') }}" data-name="ancho">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Largo <small>pulg</small>(*)</label>
						  	<input type="number" name="length" class="form-control validate-input largo" placeholder="Largo" value="{{ Input::old('length') }}" data-name="largo">
						</div>
						<div class="col-xs-12 input-field">
							<label>Peso <small>Lb</small>(*)</label>
						  	<input type="number" name="weight" class="form-control validate-input peso" placeholder="Peso" value="{{ Input::old('weight') }}" data-name="peso">
						</div>
						<div class="col-xs-12 input-field">
							<label data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo">Volumen <small>pulg<sup>3</sup></small>(*)</label>
							<input type="text" class="form-control disabled volume" disabled placeholder="Volumen" data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo" value="{{ Input::old('volume') }}">
						</div>
						<input type="hidden" name="volume" class="volume" value="{{ Input::old('volume') }}">
						<div class="col-xs-12 input-field">
							<label data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo">Flete <span class="flete-tipo"></span>(*)</label>
							<input type="text" class="form-control disabled flete" disabled placeholder="Volumen" data-toggle="tooltip" data-placement="top" data-title="Debe llenar los campos, tipo de envio, alto, ancho y largo" {{ Input::old('flete') }}>
						</div>
						<input type="hidden" name="flete" class="flete" value="{{ Input::old('flete') }}">
						<div class="col-xs-12 col-md-6 input-field">
							<label>Tipo de mercancia (*)</label>
							<input type="text" name="merc_type" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ Input::old('merc_type') }}">
						</div>
						<div class="col-xs-12 col-md-6 input-field">
							<label>Costo de la mercancia <small>USD</small>(*)</label>
							<input type="text" name="merc_value" class="form-control validate-input" placeholder="Destino de la carga (*)" data-name="Destino de la carga" value="{{ Input::old('merc_value') }}">
						</div>
						<div class="col-xs-12 input-field">
							<label>Ubicación (*)</label>
						  	<input type="text" name="location" class="form-control validate-input" placeholder="Ubicación" value="{{ Input::old('location') }}" data-name="ubicación">
						</div>
						<div class="col-xs-12 input-field">
							<label>Cantidad de cajas (*)</label>
						  	<input type="number" name="box_qty" class="form-control validate-input" placeholder="Cantidad de cajas" value="{{ Input::old('box_qty') }}" data-name="cantidad de cajas">
						</div>
						<div class="col-xs-12">
							<label>Consigna (*)</label>
							<input type="text" name="consig" class="form-control validate-input" placeholder="Consigna" value="{{ Input::old('consig') }}">
						</div>
						<div class="col-xs-12 col-md-6">
							<label>Numero de guia (*)</label>
							<input type="text" name="guide_number" class="form-control validate-input" placeholder="Numero de guia" value="{{ Input::old('guide_number') }}">
						</div>
						<div class="col-xs-12 col-md-6">
							<label>Proveedor (*)</label>
							<select class="form-control validate-input selectpicker provider-input" name="provider" data-name="proveedor" data-show-subtext="true" data-live-search="true">
								<option value="">Seleccione una opción</option>
								@foreach($providers as $p)
									<option value="{{ $p->id }}" data-phone="{{ $p->phone }}" @if(Input::old('provider') && Input::old('provider') == $p->id) selected @endif>{{ ucfirst($p->name) }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-6">
							<label>Telefono cliente</label>
							<input type="text" name="client_phone" class="form-control validate-input" placeholder="Numero de guia" value="{{ Input::old('client_phone') }}">
						</div>
						<div class="col-xs-12 col-md-6">
							<label>Telefono proveedor</label>
							<input type="text" name="provider_phone" class="form-control validate-input provider_phone" placeholder="Numero de guia" value="{{ Input::old('provider_phone') }}">
						</div>
						<div class="partial-container">
							@if(Input::old('type'))
								@if(Input::old('dest'))
									<input type="hidden" class="input_old" name="dest" value="{{ Input::old('dest') }}"> 
								@endif
								@if(Input::old('ref_no'))
									<input type="hidden" class="input_old" name="ref_no" value="{{ Input::old('ref_no') }}"> 
								@endif
								@if(Input::old('carrier'))
									<input type="hidden" class="input_old" name="carrier" value="{{ Input::old('carrier') }}"> 
								@endif
								@if(Input::old('ship_mode'))
									<input type="hidden" class="input_old" name="ship_mode" value="{{ Input::old('ship_mode') }}"> 
								@endif
								@if(Input::old('charge_type'))
									<input type="hidden" class="input_old" name="charge_type" value="{{ Input::old('charge_type') }}">
								@endif
								@if(Input::old('airport_depart'))
									<input type="hidden" class="input_old" name="airport_depart" value="{{ Input::old('airport_depart') }}">
								@endif
								@if(Input::old('airport_dest'))
									<input type="hidden" class="input_old" name="airport_dest" value="{{ Input::old('airport_dest') }}">
								@endif
								@if(Input::old('notify_party'))
									<input type="hidden" class="input_old" name="notify_party" value="{{ Input::old('notify_party') }}">
								@endif
								@if(Input::old('export_instructions'))
									<input type="hidden" class="input_old" name="export_instructions" value="{{ Input::old('export_instructions') }}">
								@endif
								@if(Input::old('place_of_reception'))
									<input type="hidden" class="input_old" name="place_of_reception" value="{{ Input::old('place_of_reception') }}">
								@endif
								@if(Input::old('shop_line'))
									<input type="hidden" class="input_old" name="shop_line" value="{{ Input::old('shop_line') }}">
								@endif
								@if(Input::old('port_of_loading'))
									<input type="hidden" class="input_old" name="port_of_loading" value="{{ Input::old('port_of_loading') }}">
								@endif
								@if(Input::old('place_of_deliver'))
									<input type="hidden" class="input_old" name="place_of_deliver" value="{{ Input::old('place_of_deliver') }}">
								@endif
							@endif
						</div>
						<div class="col-xs-12 input-field">
							<label>Observación</label>
						  	<textarea name="observation" class="form-control" placeholder="Observación" data-name="observación">{{ Input::old('observation') }}</textarea>
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

@section('postscript')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

@if(Input::old('type'))
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('[data-toggle = tooltip]').tooltip();
		var btn = $('.type');
	    var dataPost = {
	      id : btn.val()
	    };

	    $('.input_old').each(function(index, el) {
	      dataPost[$(el).attr('name')] = $(el).val();      
	    });
	    doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, beforeSelectLoad, successSelectLoad, endSelectLoadAjax);
		});
</script>
@endif
@stop