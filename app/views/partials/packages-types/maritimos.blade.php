<div class="input-field col-xs-12">
	<label>A notificar</label>
	<textarea name="notify_party" class="form-control" placeholder="A notificar">@if(isset($notify_party)){{ $notify_party }}@endif</textarea>
</div>
<div class="input-field col-xs-12">
	<label>Instrucciones de exportación</label>
	<textarea name="export_instructions" class="form-control" placeholder="Instrucciones de exportación">@if(isset($export_instructions)){{ $export_instructions }}@endif</textarea>
</div>
<div class="input-field col-xs-12">
	<label>Tienda</label>
	<input type="text" name="shop_line" class="form-control" @if(isset($shop_line)) value="{{ $shop_line }}" @endif placeholder="Tienda">
</div>
<div class="input-field col-xs-12">
	<label>Puerto de carga</label>
	<input type="text" name="port_of_loading" class="form-control" @if(isset($port_of_loading)) value="{{ $port_of_loading }}" @endif placeholder="Puerto de carga">
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Lugar de recepción</label>
	<input type="text" name="place_of_reception" class="form-control" @if(isset($place_of_reception)) value="{{ $place_of_reception }}" @endif placeholder="Lugar de recepción">
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Lugar de entrega</label>
	<input type="text" name="place_of_deliver" class="form-control" @if(isset($place_of_deliver)) value="{{ $place_of_deliver }}" @endif placeholder="Lugar de entrega">
</div>