<?php

class AerolineController extends BaseController {
	public function getAerolines()
	{
		$title = "Aerolineas | E&S Cargo";
		$aerolines = Aeroline::orderBy('id','DESC');
		$busq = "";
		if (Input::has('busq') && Input::get('busq') != "") {
			$busq = Input::get('busq');
			$aerolines = $aerolines->where('code','=',$busq);
		}
		$aerolines = $aerolines->paginate(10);
		return View::make('admin.aerolines.show')
		->with('title',$title)
		->with('busq',$busq)
		->with('aerolines',$aerolines);
	}
	public function postNewAeroline()
	{
		$data 	= Input::all();
		$rules 	= [
			'name'		=> 'required|max:100',
			'code'		=> 'required|min:100|max:999|numeric|unique:aerolines,code',
			'url'		=> 'required|url',
			'var'		=> 'required'	
		]; 
		$msg 	= [];
		$attr 	= [
			'name'	=> 'Nombre de la Aerolineas',
			'code'	=> 'Codigo',
			'url'	=> 'URL',
			'var'	=> 'variable'
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$aero = new Aeroline;
		$aero->fillData($data);
		$aero->save();
		Session::flash('success','Se ha guardado la aerolinea satisfactoriamente');
		return Redirect::back();
	}
	public function getMdfAerolinea($id)
	{
		$title = "Modificar Aerolineas | E&S Cargo";
		$aeroline = Aeroline::find($id);
		return View::make('admin.aerolines.mdf')
		->with('title',$title)
		->with('aeroline',$aeroline);
	}
	public function postMdfAeroline($id)
	{
		$data 	= Input::all();
		$rules 	= [
			'name'		=> 'required|max:100',
			'code'		=> 'required|min:100|max:999|numeric|unique:aerolines,code,'.$id,
			'url'		=> 'required|url',
			'var'		=> 'required'	
		]; 
		$msg 	= [];
		$attr 	= [
			'name'	=> 'Nombre de la Aerolineas',
			'code'	=> 'Codigo',
			'url'	=> 'URL',
			'var'	=> 'variable'
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if (!$aero = Aeroline::findOrFail($id)) {
			Session::flash('danger','Error, no se encontro el id de la aereolinea');
			return Redirect::back();	
		}
		$aero->fillData($data);
		$aero->save();
		Session::flash('success','Se ha modificado la aerolinea satisfactoriamente');
		return Redirect::to('administrador/ver-aerolineas');
	}
	public function postElim()
	{
		$id = Input::get('id');
		if (!$a = Aeroline::findOrFail($id)) {
			return Response::json([
				'type' => 'danger',
				'msg'  => 'Error, no se encontro la aerolinea'
			]);
		}
		$a->delete();
		return Response::json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado la aereolinea satisfactoriamente.'
		]);
	}
}