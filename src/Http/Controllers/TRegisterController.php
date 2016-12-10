<?php

namespace Takachaa\Tauth\Http\Controllers;

use Takachaa\Tauth\PreUser;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * TRegisterController is the Controller for registering PreUser.
 * It provides saving to the PreUser Data and notifying the need for activating account by email.
 */
class TRegisterController extends Controller
{
	use RegistersUsers;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Override from RegistersUsers trait.
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm()
	{
		return view('auth.register');
	}

	/**
	 * Override from RegistersUsers trait.
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();

		$this->create($request->all());

		return redirect('register/complete');
	}

	/**
	 * It just provides rendering view
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function registerComplete()
	{
		return view('auth.registered');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Create a new PreUser instance and save,
	 * notify the need for activating account.
	 *
	 * @param  array  $data
	 * @return PreUser
	 */
	protected function create($data)
	{
		$pre_user = new PreUser;
		$pre_user->name = $data['name'];
		$pre_user->email = $data['email'];
		$pre_user->password = bcrypt($data['password']);
		$pre_user->setActivationToken();

		$pre_user->save();
		$pre_user->sendActivationNotification($pre_user->activation_token);
		return $pre_user;
	}
}
