<?php

class Package extends Eloquent{
	public function user()
	{
		return $this->belongsTo('User','user_id');
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
		if (isset($dat['observation'])) {
			$this->observation 	= $data['observation'];
		}
		$this->user_id 		= $data['user'];
	}
}
