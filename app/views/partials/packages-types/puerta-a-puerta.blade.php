<div class="input-field col-xs-12">
	<label>Numero de referencia </label>
	<input type="text" name="ref_no" class="form-control" @if(isset($ref_no)) value="{{ $ref_no }}" @endif placeholder="Numero de referencia">
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Destino (*)</label>
	<input type="text" name="dest" class="form-control validate-input" @if(isset($dest)) value="{{ $dest }}" @endif placeholder="Destino">
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Carrier (*)</label>
	<input type="text" name="carrier" class="form-control validate-input" @if(isset($carrier)) value="{{ $carrier }}" @endif placeholder="Carrier">
</div>
<div class="input-field col-xs-12">
	<label>Modo de envio (*)</label>
	<select class="form-control validate-input" name="ship_mode">
		<option value="air" @if(isset($ship_mode) && $ship_mode == "air") selected @endif>Air</option> 
		<option value="air-P2P" @if(isset($ship_mode) && $ship_mode == "air-P2P") selected @endif>Air-P2P</option> 
		<option value="in/out" @if(isset($ship_mode) && $ship_mode == "in/out") selected @endif>In/Out</option> 
		<option value="inland" @if(isset($ship_mode) && $ship_mode == "inland") selected @endif>Inland</option> 
		<option value="ocean-1" @if(isset($ship_mode) && $ship_mode == "ocean-1") selected @endif>Ocean-1</option> 
		<option value="ocean-P2P" @if(isset($ship_mode) && $ship_mode == "ocean-P2P") selected @endif>Ocean-P2P</option> 
	</select>
</div>