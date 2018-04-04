<?php

class Package extends Eloquent{
	public function shipper()
	{
		return $this->belongsTo('User','shipper_id');
	}
	public function status()
	{
		return $this->belongsTo('Status','status_id');
	}
	public function createdBy()
	{
		return $this->belongsTo('User','created_by');
	}
	public function types()
	{
		return $this->belongsTo('Type','package_type');
	}
	public function updatedBy()
	{
		return $this->belongsTo('User','updated_by');
	}
	public function descs()
	{
		return $this->hasOne('PackageDesc','package_id');
	}
	public function providers()
	{
		return $this->belongsTo('Provider','provider_id');
	}
	public function fillData($data)
	{
		$this->shipper_id 	= $data['shipper'];
		$this->box_qty 		= $data['box_qty'];
		$this->weight 		= $data['weight'];
		$this->package_type = $data['type'];
		$this->height 		= $data['height'];
		$this->width 		= $data['width'];
		$this->length 		= $data['length'];
		$this->consignee 	= $data['consig'];
		$this->location 	= $data['location'];
		$this->origin				= $data['origin'];
		$this->destination			= $data['destination'];
		$this->volumen				= $data['volume'];
		$this->flete				= $data['flete'];
		$this->merc_type			= $data['merc_type'];
		$this->merc_value			= $data['merc_value'];
		$this->guide_number			= $data['guide_number'];
		$this->provider_id			= $data['provider'];
		if (isset($data['observation'])) {
			$this->observation 	= $data['observation'];
		}
		if (isset($data['client_phone'])) {
			$this->client_phone 	= $data['client_phone'];
		}
		if (isset($data['provider_phone'])) {
			$this->provider_phone 	= $data['provider_phone'];
		}
	}
}
