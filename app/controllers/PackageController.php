<?php

class PackageController extends BaseController {

	public function getNewPackage()
	{
		$title = "Nuevo Paquete | nombredelapagina";
		$types = Type::get();
		$users = User::with('country')
		->whereHas('roles',function($roles){
			$roles->where('slug','=','cliente');
		})
		->get();
		$shippers = Shipper::get();
		return View::make('admin.packages.new')
		->with('title',$title)
		->with('types',$types)
		->with('users',$users)
		->with('shippers',$shippers);
	}
	public function postNewPackage()
	{
		$data = Input::all();
		$rules = array(
			'type'					=> 'required|exists:types,id',
			'shipper'				=> 'required|exists:users,id',
			'height'				=> 'required|numeric|min:1',
			'width'					=> 'required|numeric|min:1',
			'length'				=> 'required|numeric|min:1',
			'weight'				=> 'required|numeric|min:1',
			'location'				=> 'required|min:4|max:50',
			'observation'			=> 'sometimes|min:4|max:200',
			'box_qty'				=> 'required|min:1',
			'consig'				=> 'required|min:1|max:50',
			'origin'				=> 'required|max:500',
			'destination'			=> 'required|max:500',
			'volume'				=> 'sometimes|numeric',
			'flete'					=> 'sometimes|numeric',
			'merc_type'				=> 'required|max:500',
			'merc_value'			=> 'required',
		);
		if (Input::has('type')) {
			if ($data['type'] == 'puerta-a-puerta') {
				$rules['carrier']				= 'required|min:1|max:100';
				$rules['dest']					= 'required|min:1|max:100';
				$rules['ref_no']				= 'sometimes|min:1|max:100';
				$rules['ship_mode']				= 'required|in:air,air-P2P,in/out,inland,ocean-1,ocean-P2P';
			}elseif($data['type'] == "aereos")
			{
				$rules['charge_type']			= 'required|in:all-charges,as-agreed,freight-only,mixed';
				$rules['airport_depart']		= 'required|min:1|max:100';
				$rules['airport_dest']			= 'required|min:1|max:100';
			}elseif($data['type'] == "maritimos")
			{
				$rules['notify_party']			= 'sometimes|min:1|max:100';
				$rules['export_instructions']	= 'sometimes|min:1|max:100';
				$rules['place_of_reception']	= 'sometimes|min:1|max:100';
				$rules['shop_line']				= 'sometimes|min:1|max:100';
				$rules['port_of_loading']		= 'sometimes|min:1|max:100';
				$rules['place_of_deliver']		= 'sometimes|min:1|max:100';
				
			}
		}
		$msg = array(

		);
		$attr = array(
			'type'					=> 'tipo de envio',
			'shipper'				=> 'remitente',
			'height'				=> 'alto',
			'width'					=> 'ancho',
			'length'				=> 'largo',
			'weight'				=> 'peso',
			'location'				=> 'ubicación',
			'observation'			=> 'observación',
			'box_qty'				=> 'cantidad de cajas',
			'user'					=> 'usuario a asignar',
			'consig'				=> 'consigna',
			'origin'				=> 'origen',
			'destination'			=> 'destino',
			'volume'				=> 'volumen',
			'flete'					=> 'flete',
			'merc_type'				=> 'tipo de mercancia',
			'merc_value'			=> 'valor de la mercancia',
		);
		if (Input::has('type')) {
			if ($data['type'] == 'puerta-a-puerta') {
				$attr['carrier']				= 'carrier';
				$attr['dest']					= 'destino';
				$attr['ref_no']					= 'numero de referencia';
				$attr['ship_mode']				= 'Modo de envio';
			}elseif($data['type'] == "aereos")
			{
				$attr['charge_type']			= 'tipo de carga';
				$attr['airport_depart']			= 'Aeropuerto de salida';
				$attr['airport_dest']			= 'Aeropuerto destino';
			}elseif($data['type'] == "maritimos")
			{
				$attr['notify_party']			= 'A notificar';
				$attr['export_instructions']	= 'Instrucciones de exportación';
				$attr['place_of_reception']		= 'Tienda';
				$attr['shop_line']				= 'Puerto de carga';
				$attr['port_of_loading']		= 'Lugar de recepción';
				$attr['place_of_deliver']		= 'Lugar de entrega';
				
			}
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$type = Type::find($data['type']);
		$package = new Package;
		$package->fillData($data);
		$package->created_by    = Auth::id();
		$package->updated_by    = Auth::id();
		$package->status_id     = Status::where('slug','=','procesando')->first()->id;
		$package->save();

		$packDesc = new PackageDesc;
		$packDesc->package_id = $package->id;
		$packDesc->fillData($data, $type);
		$packDesc->save();
		Session::flash('success', 'Se ha agregado el nuevo paquete satisfactoriamente.');
		return Redirect::back();
	}
	public function getShowPackages()
	{
		$title = "Ver paquetes | nombredelapagina";
		$busq = "";
		$packages = Package::with('shipper')
		->with('status')
		->with('createdBy')
		->with('updatedBy')
		->orderBy('id','DESC');
		if (Input::has('busq') && Input::get('busq') != "") {
			$busq = Input::get('busq');
			$packages = $packages->where(function($query) use ($busq){
				$query->where('id','=',$busq);
			})
			->orWhereHas('shipper',function($shipper) use ($busq){
				$shipper->where('username','=',$busq);
			});
		}

		$packages = $packages->paginate(10);
		$status = Status::get();
		return View::make('admin.packages.show')
		->with('title',$title)
		->with('packages',$packages)
		->with('busq',$busq)
		->with('status',$status);
	}
	public function getPackageLocations()
	{
		$id = Input::get('id');
		$locations = PackageLocation::where('package_id','=',$id)->orderBy('id','DESC')->get();
		$package  = Package::find($id);
		return View::make('partials.locations')
		->with('locations',$locations)
		->with('package',$package);
	}
	public function getMdfPackage($id)
	{
		$title = "Modificar paquete | nombredelapagina";
		$package = Package::with('types')->find($id);
		$types   = Type::get();

		$users = User::whereHas('roles',function($roles){
			$roles->where('slug','=','cliente');
		})
		->get();
		return View::make('admin.packages.mdf')
		->with('title',$title)
		->with('types',$types)
		->with('package',$package)
		->with('users',$users);
	}
	public function postMdfPackage($id)
	{
		$data = Input::all();
		$rules = array(
			'type'					=> 'required|exists:types,id',
			'shipper'				=> 'required|exists:users,id',
			'height'				=> 'required|numeric|min:1',
			'width'					=> 'required|numeric|min:1',
			'length'				=> 'required|numeric|min:1',
			'weight'				=> 'required|numeric|min:1',
			'location'				=> 'required|min:4|max:50',
			'observation'			=> 'sometimes|min:4|max:200',
			'box_qty'				=> 'required|min:1',
			'consig'				=> 'required|min:1|max:50',
			'origin'				=> 'required|max:500',
			'destination'			=> 'required|max:500',
			'volume'				=> 'sometimes|numeric',
			'flete'					=> 'sometimes|numeric',
			'merc_type'				=> 'required|max:500',
			'merc_value'			=> 'required',
		);
		if (Input::has('type')) {
			if ($data['type'] == 'puerta-a-puerta') {
				$rules['carrier']				= 'required|min:1|max:100';
				$rules['dest']					= 'required|min:1|max:100';
				$rules['ref_no']				= 'sometimes|min:1|max:100';
				$rules['ship_mode']				= 'required|in:air,air-P2P,in/out,inland,ocean-1,ocean-P2P';
			}elseif($data['type'] == "aereos")
			{
				$rules['charge_type']			= 'required|in:all-charges,as-agreed,freight-only,mixed';
				$rules['airport_depart']		= 'required|min:1|max:100';
				$rules['airport_dest']			= 'required|min:1|max:100';
			}elseif($data['type'] == "maritimos")
			{
				$rules['notify_party']			= 'sometimes|min:1|max:100';
				$rules['export_instructions']	= 'sometimes|min:1|max:100';
				$rules['place_of_reception']	= 'sometimes|min:1|max:100';
				$rules['shop_line']				= 'sometimes|min:1|max:100';
				$rules['port_of_loading']		= 'sometimes|min:1|max:100';
				$rules['place_of_deliver']		= 'sometimes|min:1|max:100';
				
			}
		}
		$msg = array(

		);
		$attr = array(
			'type'					=> 'tipo de envio',
			'shipper'				=> 'remitente',
			'height'				=> 'alto',
			'width'					=> 'ancho',
			'length'				=> 'largo',
			'weight'				=> 'peso',
			'location'				=> 'ubicación',
			'observation'			=> 'observación',
			'box_qty'				=> 'cantidad de cajas',
			'user'					=> 'usuario a asignar',
			'consig'				=> 'consigna',
			'origin'				=> 'origen',
			'destination'			=> 'destino',
			'volume'				=> 'volumen',
			'flete'					=> 'flete',
			'merc_type'				=> 'tipo de mercancia',
			'merc_value'			=> 'valor de la mercancia',
		);
		if (Input::has('type')) {
			if ($data['type'] == 'puerta-a-puerta') {
				$attr['carrier']				= 'carrier';
				$attr['dest']					= 'destino';
				$attr['ref_no']					= 'numero de referencia';
				$attr['ship_mode']				= 'Modo de envio';
			}elseif($data['type'] == "aereos")
			{
				$attr['charge_type']			= 'tipo de carga';
				$attr['airport_depart']			= 'Aeropuerto de salida';
				$attr['airport_dest']			= 'Aeropuerto destino';
			}elseif($data['type'] == "maritimos")
			{
				$attr['notify_party']			= 'A notificar';
				$attr['export_instructions']	= 'Instrucciones de exportación';
				$attr['place_of_reception']		= 'Tienda';
				$attr['shop_line']				= 'Puerto de carga';
				$attr['port_of_loading']		= 'Lugar de recepción';
				$attr['place_of_deliver']		= 'Lugar de entrega';
				
			}
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$type = Type::find($data['type']);
		$package = Package::find($id);
		$package->fillData($data);
		$package->updated_by    = Auth::id();
		$package->save();

		$packDesc = PackageDesc::where('package_id','=',$package->id)->first();
		$packDesc->fillData($data, $type);
		$packDesc->save();

		Session::flash('success', 'Se ha modificado el paquete satisfactoriamente.');
		return Redirect::back();
	}
	public function postChangeStatus()
	{
		$id = Input::get('id');
		$status = Input::get('to_send');

		$package = Package::find($id);
		$package->status_id = $status;
		$package->save();
		$data['package']     = $id;
		$data['description'] = Status::find($package->status_id)->description;
		
		$to_email = User::find($package->shipper_id)->email;
		Mail::queue('emails.status-changed', $data, function($message) use ($to_email, $data)
		{
			$message->to($to_email)
			->from('administracion@nombredelapagina.com')
			->subject('Se ha actualizado el status de su paquete');
		});
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'se ha cambiado el status satisfactoriamente.'
		));
	}
	public function postChangeLocation()
	{
		$id = Input::get('id');
		$loc = Input::get('to_send');

		$package = Package::find($id);
		
		$location = new PackageLocation;
		$location->package_id = $package->id;
		$location->location   = $package->location;
		$location->save();

		$package->location    = $loc;
		$package->save();

		$data['package']     = $id;
		$data['description'] = Status::find($package->status_id)->description;
		
		$to_email = User::find($package->shipper_id)->email;
		Mail::queue('emails.location-changed', $data, function($message) use ($to_email, $data)
		{
			$message->to($to_email)
			->from('administracion@nombredelapagina.com')
			->subject('Se ha actualizado la ubicación de su paquete');
		});
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'se ha cambiado la ubicación satisfactoriamente.'
		));
	}
	public function postElimPackage()
	{
		$id = Input::get('id');
		Package::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado el paquete satisfactoriamente.'
		));

	}
	public function getPackages($type)
	{
		$title = "Ver mis paquetes | nombredelapagina";
		$busq = "";
		$packages = Package::where('shipper_id','=',Auth::id())->orderBy('id','DESC');

		if ($type == "no-entregados") {
			$packages = $packages->whereHas('status',function($status){
				$status->where('slug','!=','entregado');
			});
		}
		if ($type == "entregados") {
			$packages = $packages->whereHas('status',function($status){
				$status->where('slug','=','entregado');
			});
		}
		$packages = $packages->paginate(10);
		return View::make('cliente.packages')
		->with('title',$title)
		->with('packages',$packages)
		->with('busq',$busq);
	}
	public function getFields()
	{
		$id = Input::get('id');

		$type = Type::find($id);
		$view = View::make('partials.packages-types.'.$type->slug);
		if(Input::has('dest')){
			$dest = Input::get('dest');
			$view = $view->with('dest',$dest);
		}
		if(Input::has('ref_no')){
			$ref_no = Input::get('ref_no');
			$view = $view->with('ref_no',$ref_no);
		}
		if(Input::has('carrier')){
			$carrier = Input::get('carrier');
			$view = $view->with('carrier',$carrier);
		}
		if(Input::has('ship_mode')){
			$ship_mode = Input::get('ship_mode');
			$view = $view->with('ship_mode',$ship_mode);
		}
		if(Input::has('charge_type')){
			$charge_type = Input::get('charge_type');
			$view = $view->with('charge_type',$charge_type);
		}
		if(Input::has('airport_depart')){
			$airport_depart = Input::get('airport_depart');
			$view = $view->with('airport_depart',$airport_depart);
		}
		if(Input::has('airport_dest')){
			$airport_dest = Input::get('airport_dest');
			$view = $view->with('airport_dest',$airport_dest);
		}
		if(Input::has('notify_party')){
			$notify_party = Input::get('notify_party');
			$view = $view->with('notify_party',$notify_party);
		}
		if(Input::has('export_instructions')){
			$export_instructions = Input::get('export_instructions');
			$view = $view->with('export_instructions',$export_instructions);
		}
		if(Input::has('place_of_reception')){
			$place_of_reception = Input::get('place_of_reception');
			$view = $view->with('place_of_reception',$place_of_reception);
		}
		if(Input::has('shop_line')){
			$shop_line = Input::get('shop_line');
			$view = $view->with('shop_line',$shop_line);
		}
		if(Input::has('port_of_loading')){
			$port_of_loading = Input::get('port_of_loading');
			$view = $view->with('port_of_loading',$port_of_loading);
		}
		if(Input::has('place_of_deliver')){
			$place_of_deliver = Input::get('place_of_deliver');
			$view = $view->with('place_of_deliver',$place_of_deliver);
		}
		return $view;
	}
	public function getCaracteristics()
	{
		$id = Input::get('id');
		$package = Package::with('types')->with('descs')->find($id);

		return View::make('partials.packageDesc')
		->with('package',$package);
	}
}