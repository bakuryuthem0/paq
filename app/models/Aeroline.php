<?php

class Aeroline extends Eloquent{
	public function fillData($data)
	{
		$this->name = $data['name'];
		$this->code = $data['code'];
		$this->url  = $data['url'];
		$this->variable_name = $data['var'];
	}
}