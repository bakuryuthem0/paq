<?php

class ProviderController extends BaseController {
	public function getProviders()
	{
		$title = "Gestionar Proveedores | E&S Cargo";
		$providers = Provider::orderBy('id','DESC');
		$busq = "";
		if (Input::has('busq') && Input::get('busq') != "") {
			$busq = Input::get('busq');
			$providers = $providers->where('code','=',$busq)
			->orWhere(function($name) use ($busq)
			{
				$name->where('name','LIKE','%'.$busq)
				->orWhere('name','LIKE','%'.$busq.'%')
				->orWhere('name','LIKE',$busq.'%');
			});
		}
		$providers = $providers->paginate(6);
		return View::make('admin.providers.show')
		->with('title',$title)
		->with('busq',$busq)
		->with('providers',$providers);
	}
	public function postNewProvider()
	{
		$data 	= Input::all();
		$rules 	= [
			'name'		=> 'required|max:100',
			'code'		=> 'sometimes|unique:providers,code',
		]; 
		$msg 	= [];
		$attr 	= [
			'name'	=> 'Nombre de la Aerolineas',
			'code'	=> 'Codigo',
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$provider = new Provider;
		$provider->fillData($data);
		$provider->save();
		Session::flash('success','Se ha guardado al proveedor satisfactoriamente');
		return Redirect::back();
	}
	public function getMdfProdiver($id)
	{
		$title = "Modificar Proveedor | E&S Cargo";
		$provider = Provider::find($id);
		return View::make('admin.providers.mdf')
		->with('title',$title)
		->with('provider',$provider);
	}
	public function postMdfProvider($id)
	{
		$data 	= Input::all();
		$rules 	= [
			'name'		=> 'required|max:100',
			'code'		=> 'sometimes|unique:providers,code,'.$id,
		]; 
		$msg 	= [];
		$attr 	= [
			'name'	=> 'Nombre de la Aerolineas',
			'code'	=> 'Codigo',
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if (!$provider = Provider::findOrFail($id)) {
			Session::flash('danger','Error, no se encontro el id del proveedor');
			return Redirect::back();	
		}
		$provider->fillData($data);
		$provider->save();
		Session::flash('success','Se ha modificado el proveedor satisfactoriamente');
		return Redirect::to('administrador/ver-proveedores');
	}
	public function postElim()
	{
		$id = Input::get('id');
		if (!$p = Provider::findOrFail($id)) {
			return Response::json([
				'type' => 'danger',
				'msg'  => 'Error, no se encontro el proveedor'
			]);
		}
		$p->delete();
		return Response::json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado el proveedor satisfactoriamente.'
		]);
	}
}