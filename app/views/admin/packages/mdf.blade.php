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
						  	<select class="form-control validate-input type" name="type" data-name="tipo de envio" data-target=".partial-container" data-url="{{ URL::to('administrador/cargar-campos') }}">
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
								@foreach($shippers as $s)
								<option value="{{ $s->id }}" @if($package->shipper_id== $s->id) selected @endif>{{ $s->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Alto <small>pulg</small>(*)</label>
						  	<input type="number" name="height" class="form-control validate-input" placeholder="Alto" value="{{ $package->height }}" data-name="peso">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Ancho <small>pulg</small>(*)</label>
						  	<input type="number" name="width" class="form-control validate-input" placeholder="Ancho" value="{{ $package->width }}" data-name="peso">
						</div>
						<div class="col-xs-12 col-md-4 input-field">
							<label>Largo <small>pulg</small>(*)</label>
						  	<input type="number" name="length" class="form-control validate-input" placeholder="Largo" value="{{ $package->length }}" data-name="peso">
						</div>
						<div class="col-xs-12 input-field">
							<label>Peso <small>Lb</small>(*)</label>
						  	<input type="number" name="weight" class="form-control validate-input" placeholder="Peso" value="{{ $package->weight }}" data-name="peso">
						</div>
						<div class="col-xs-12 input-field">
							<label>Ubicación (*)</label>
						  	<input type="text" name="location" class="form-control validate-input" placeholder="Ubicación" value="{{ $package->location }}" data-name="ubicación">
						</div>
						<div class="col-xs-12 input-field">
							<label>Observación</label>
						  	<input type="text" name="observation" class="form-control" placeholder="Observación" value="{{ $package->observation }}" data-name="observación">
						</div>
						<div class="col-xs-12 input-field">
							<label>Cantidad de cajas (*)</label>
						  	<input type="number" name="box_qty" class="form-control validate-input" placeholder="Cantidad de cajas" value="{{ $package->box_qty }}" data-name="cantidad de cajas">
						</div>
						<div class="col-xs-12 input-field">
							<label>Usuario (*)</label>
							<select class="form-control validate-input selectpicker" name="user" data-name="usuario" data-show-subtext="true" data-live-search="true">
								<option value="">Seleccione una opción</option>
								@foreach($users as $u)
									<option value="{{ $u->id }}" @if($package->user_id == $u->id) selected @endif>{{ ucfirst($u->username) }}</option>
								@endforeach
							</select>
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
							@elseif($package->types->slug == 'aeros')
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

<script type="text/javascript">
	jQuery(document).ready(function($) {
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
@stop