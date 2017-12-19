<?php

class PackageDesc extends Eloquent{
	public function fillData($data, $type)
	{
		if(isset($type)){
			if ($type->slug == 'puerta-a-puerta') {
				$this->carrier				= $data['carrier'];
				if(isset($data['dest'])){
					$this->dest					= $data['dest'];
				}
				$this->reference_number		= $data['ref_no'];
				$this->ship_mode			= $data['ship_mode'];
			}elseif($type->slug == "aereos")
			{
				$this->charge_type			= $data['charge_type'];
				$this->airport_depart		= $data['airport_depart'];
				$this->airport_dest			= $data['airport_dest'];
			}elseif($type->slug == "maritimos")
			{
				if(isset($data['notify_party'])){
					$this->notify_party			= $data['notify_party'];
				}
				if(isset($data['export_instructions'])){
					$this->export_instructions	= $data['export_instructions'];
				}
				if(isset($data['place_of_reception'])){
					$this->place_of_reception	= $data['place_of_reception'];
				}
				if(isset($data['shop_line'])){
					$this->shop_line			= $data['shop_line'];
				}
				if(isset($data['port_of_loading'])){
					$this->port_of_loading		= $data['port_of_loading'];
				}
				if(isset($data['place_of_deliver'])){
					$this->place_of_deliver		= $data['place_of_deliver'];
				}
				
			}
		}
	}
}