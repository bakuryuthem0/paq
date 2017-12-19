<?php

Class UserLib{
	public static function getUserRole()
	{
		return Role::find(Auth::user()->role_id);
	}
}