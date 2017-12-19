<?php

class AuthController extends BaseController {

	public function getLogin()
	{
		$title = "Administración del sition | nombredelapagina";
		return View::make('auth.login')
		->with('title',$title);
	}
	public function postLogin()
	{
		$data = Input::all();
		$rules = array(
			'username' => 'required|exists:users,username',
			'password' => 'required'
		);
		$msg = array();
		$attr = array(
			'password' => 'contraseña'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$credentials = [
			'username' => $data['username'],
			'password' => $data['password']
		];
		if (Auth::attempt($credentials)) {
			return Redirect::to('/');
		}

		return Redirect::back();
	}
	public function getLogOut()
	{
		Auth::logout();
		return Redirect::to('login');
	}
	public function getRecoverPassword()
	{
		$email = Input::get('to_send');

		$user = User::where('email','=',$email)->first();
		if (!empty($user)) {
			$recover = RecoverPassword::where('hash','=',md5($user->id))
			->where(function($q){
				$q->where('duration','<=',time())
				->where('was_used','=',0);
			})
			->first();
			if (!empty($recover)){
				return Response::json(array(
					'type' => 'warning',
					'msg'  => 'Ya usted ha solicitado un cambio de contraseña, y este continua activo'
				));
			}
			$recover = new RecoverPassword;
			$recover->user_id = $user->id;
			$recover->hash    = md5($user->id);
			$recover->duration= time()+7200;
			$recover->save();

			$data['hash'] = $recover->hash;
			$to_email = $user->email;

			Mail::queue('emails.recover-pass', $data, function($message) use ($to_email, $data)
			{
				$message->to($to_email)
				->from('administracion@nombredelapagina.com')
				->subject('Correo de cambio de contraseña nombredelapagina');
			});
			return Response::json(array(
				'type' => 'success',
				'msg'  => 'Se le a enviado un email para proseguir el proceso de cmbio de contraseña'
			));
		}
		return Response::json(array(
			'type' => 'danger',
			'msg'  => 'Error, no se encontro el email enviado'
		));
	}
	public function getRecoverHash($hash)
	{
		$recover = RecoverPassword::where('hash','=',$hash)
		->where('duration','<=',time())
		->where('was_used','=',0)
		->first();
		if (!empty($recover)){
			$title = "Recuperar contraseña | nombredelapagina";
			$user = User::find($recover->user_id);
			return View::make('auth.recover')
			->with('id',$user->id)
			->with('hash',$recover->hash)
			->with('title',$title);
		}
		Session::flash('danger', 'El token no se encontro, fue utilizado o ya caduco, intente de nuevo a traves de la pagian web');
		return Redirect::to('login');
	}
	public function postRecoverHash($hash)
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
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = User::find($data['user_id']);
		$user->password = Hash::make($data['password']);
		$user->save();	

		$recover = RecoverPassword::where('hash','=',$hash)->first();
		$recover->was_used = 1;
		$recover->save();
		Session::flash('success', 'Se ha cambiado su contraseña satisfactoriamente.');
		return Redirect::to('login');
	}
}
