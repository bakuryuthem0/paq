<?php

class AdminController extends BaseController {

	public function getNewShipper()
	{
		$title = "Nuevo remitente | nombredelapagina";

		return View::make('admin.shippers.new')
		->with('title',$title);
	}
	public function postNewShipper()
	{
		$data = Input::all();
		$rules = array(
			'name'		=> 'sometimes|min:1|max:100',
			'address'	=> 'sometimes|min:1',
			'city'		=> 'sometimes|min:1|max:50',
			'state'		=> 'sometimes|min:1|max:50',
			'code'		=> 'sometimes|min:1|max:10',
			'phone'		=> 'sometimes|min:1|max:14',
		);
		$msg = array(

		);
		$attr = array(
			'name'		=> 'nombre/alias',
			'address'	=> 'dirección',
			'city'		=> 'ciudad',
			'state'		=> 'estado',
			'code'		=> 'codigo zip',
			'phone'		=> 'telefono',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$shipper = new Shipper;
		$shipper->fillData($data);
		$shipper->save();

		Session::flash('success', 'Se ha agregado el nuevo remitente satisfactoriamente.');
		return Redirect::back();
	}
	public function getShowShippers()
	{
		$title = "Ver remitentes | nombredelapagina";
		$busq = "";
		$shippers = Shipper::orderBy('id','DESC');
		if (Input::has('busq') && Input::get('busq') != "") {
			$busq = Input::get('busq');
			$shippers = $shippers->where(function($query) use ($busq){
				$query->where('id','=',$busq);
			});
		}

		$shippers = $shippers->paginate(10);
		return View::make('admin.shippers.show')
		->with('title',$title)
		->with('shippers',$shippers)
		->with('busq',$busq);
	}
	public function getMdfShipper($id)
	{
		$title = "Modificar remitente | nombredelapagina";
		$shipper = Shipper::find($id);
		return View::make('admin.shippers.mdf')
		->with('title',$title)
		->with('shipper',$shipper);
	}
	public function postMdfShipper($id)
	{
		$data = Input::all();
		$rules = array(
			'name'		=> 'sometimes|min:1|max:100',
			'address'	=> 'sometimes|min:1',
			'city'		=> 'sometimes|min:1|max:50',
			'state'		=> 'sometimes|min:1|max:50',
			'code'		=> 'sometimes|min:1|max:10',
			'phone'		=> 'sometimes|min:1|max:14',
		);
		$msg = array(

		);
		$attr = array(
			'name'		=> 'nombre/alias',
			'address'	=> 'dirección',
			'city'		=> 'ciudad',
			'state'		=> 'estado',
			'code'		=> 'codigo zip',
			'phone'		=> 'telefono',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$shipper = Shipper::find($id);
		$shipper->fillData($data);
		$shipper->save();

		Session::flash('success', 'Se ha modificado el remitente satisfactoriamente.');
		return Redirect::back();
	}
	
	public function postElimShipper()
	{
		$id = Input::get('id');
		Shipper::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado el remitente satisfactoriamente.'
		));

	}
}