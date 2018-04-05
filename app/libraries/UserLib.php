<?php

Class UserLib{
	public static function getUserRole()
	{
		return Role::find(Auth::user()->role_id);
	}
	public static function checkAeroline($number)
	{
		$aero = Aeroline::where('code','=',$number)->first();
		return $aero;

	}
}