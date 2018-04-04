<?php

class Provider extends Eloquent{
	public function fillData($data)
	{
		$this->name = $data['name'];
		if (isset($data['phone'])) {
			$this->phone = $data['phone'];
		}
		if (isset($data['code'])) {
			$this->code = $data['code'];
		}
	}
}