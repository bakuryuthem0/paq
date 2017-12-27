<div class="input-field col-xs-12">
	<label>Tipo de cargos</label>
	<select class="form-control validate-input" name="charge_type">
		<option value="all-charges" @if(isset($charge_type) && $charge_type == "all-charges") selected @endif>All Charges</option>
		<option value="as-agreed" @if(isset($charge_type) && $charge_type == "as-agreed") selected @endif>As Agreed </option>
		<option value="freight-only" @if(isset($charge_type) && $charge_type == "freight-only") selected @endif>Freight Only  </option>
		<option value="mixed" @if(isset($charge_type) && $charge_type == "mixed") selected @endif>Mixed  </option>
	</select>
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Aeropuerto de salida (*)</label>
	<input type="text" name="airport_depart" class="form-control validate-input" @if(isset($airport_depart)) value="{{ $airport_depart }}" @endif placeholder="Aeropuerto de salida">
</div>
<div class="input-field col-xs-12 col-md-6">
	<label>Aeropuerto destino (*)</label>
	<input type="text" name="airport_dest" class="form-control validate-input" @if(isset($airport_dest)) value="{{ $airport_dest }}" @endif placeholder="Aeropuerto destino">
</div>