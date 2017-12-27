<?php

class UserController extends BaseController {

	public function getNewUser()
	{
		$title = "Nuevo Usuario";

		$roles = Role::where('id', '>',Auth::user()->role_id)
		->get();
		$country  = Country::get();

		return View::make('admin.users.new')
		->with('title',$title)
		->with('country',$country)
		->with('roles',$roles);
	}
	public function postNewUser()
	{
		$data  = Input::all();
		$rules = array(
			'username' => 'required|unique:users,username|min:4|max:16',
			'password' => 'required|min:6|max:16|confirmed',
			'email'	   => 'required|email|unique:users,email',
			'name'	   => 'required|min:3|max:50',
			'role'	   => 'required|exists:roles,id',
			'country'  => 'required|exists:countries,id'
		);
		$msg  = array();
		$attr = array(
			'password'=> 'Contraseña',
			'role'	  => 'rol',
			'name'	  => 'nombre completo',
			'country' => 'País'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			Session::flash('danger', 'Error, datos invalidos');
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = new User;
		$user->username 	= $data['username'];
		$user->password 	= Hash::make($data['password']);
		$user->email    	= $data['email'];
		$user->role_id  	= $data['role'];
		$user->full_name	= $data['name'];
		$user->country_id   = $data['country'];
		$user->save();

		Session::flash('success', 'Se ha creado al usuario satisfactoriamente.');
		return Redirect::back();

	}
	public function getShowUsers()
	{
		$title = "Ver Usuarios";
		$busq = "";
		$users = User::with('roles')
		->with('country')
		->where('id','!=',Auth::id())
		->where('role_id','>',Auth::user()->role_id)
		->orderBy('id','DESC');
		if (Input::has('busq') && Input::get('busq') != "") {
			$busq = Input::get('busq');
			$users = $users->where(function($query) use ($busq){
				$query->where('id','=',$busq)
				->orWhere(function($user) use($busq){
					$user->where('username','LIKE','%'.$busq)
					->orWhere('username','LIKE','%'.$busq.'%')
					->orWhere('username','LIKE',$busq.'%');
				})
				->orWhere(function($email) use ($busq){
					$email->where('email','LIKE','%'.$busq)
					->orWhere('email','LIKE','%'.$busq.'%')
					->orWhere('email','LIKE',$busq.'%');
				});
			});
		}

		$users = $users->paginate(10);
		$roles = Role::where('id','>',Auth::user()->role_id)->get();
		return View::make('admin.users.show')
		->with('title',$title)
		->with('users',$users)
		->with('roles',$roles)
		->with('busq',$busq);
	}
	public function postElimUser()
	{
		$id = Input::get('id');

		User::find($id)->delete();

		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado al usuario satisfactoriamente.'
		));
	}
	public function getPasswordChange($id)
	{
		$title = "Cambio de contraseña";
		$user  = User::with('roles')
		->find($id);
		return View::make('admin.users.changePass')
		->with('title',$title)
		->with('user',$user);
	}
	public function postChangePass($id)
	{
		$data  = Input::all();
		$rules = array(
			'password' => 'required|min:6|max:16|confirmed',
		);
		$msg  = array();
		$attr = array(
			'password'=> 'Contraseña',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			Session::flash('danger', 'Error, datos invalidos');
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = User::find($id);
		$user->password = Hash::make($data['password']);
		$user->save();

		Session::flash('success', 'Se ha cambiado la contraseña satisfactoriamente.');
		return Redirect::back();
	}
	public function postMdfRole()
	{
		$id   = Input::get('id');
		$role = Input::get('to_send');

		$user = User::find($id);
		$user->role_id = $role;
		$user->save();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha cambiado el rol del usuario'
		));
	}
}