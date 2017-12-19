<?php

class Shipper extends Eloquent{
	public function fillData($data)
	{
		if(isset($data['name'])){
			$this->name 	= $data['name'];
		}else{
			$this->name 	= "";
		}
		if(isset($data['address'])){
			$this->address 	= $data['address'];
		}else{
			$this->address 	= "";
		}
		if(isset($data['city'])){
			$this->city 	= $data['city'];
		}else{
			$this->city 	= "";
		}
		if(isset($data['state'])){
			$this->state 	= $data['state'];
		}else{
			$this->state 	= "";
		}
		if(isset($data['code'])){
			$this->zip 		= $data['code'];
		}else{
			$this->zip 		= "";
		}
		if(isset($data['phone'])){
			$this->phone 	= $data['phone'];
		}else{
			$this->phone 	= "";
		}
	}
}