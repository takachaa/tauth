<?php

namespace Takachaa\Tauth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Takachaa\Tauth\PreUser;
use App\User;
use Carbon\Carbon;

/**
 * TActivateController is the Controller for activating account of PreUser.
 * It provides saving the User Data and updating the PreUser Data.
 */
class TActivateController extends Controller
{

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
	 * Handle a activating account request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  String $token
	 * @return \Illuminate\Http\Response
	 */
	public function activateAccount(Request $request, $token = null){

		$pre_user = PreUser::where('activation_token', $token)
							->where('confirmed', false)
							->where('created_at', '>', Carbon::now()->subHour())
							->first();


		if (!$pre_user || User::where('email', $pre_user->email)->first()) {
			return redirect('activate/error');
		}

		\DB::transaction(function () use ($pre_user){

			$user = new User;
			$user->name = $pre_user->name;
			$user->email = $pre_user->email;
			$user->password = $pre_user->password;

			$pre_user->confirmed = true;
			$pre_user->save();
			$user->save();
		});

		return redirect('activate/complete');
	}

	/**
	 * It just provides rendering view
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function activateComplete(){
		return view('auth.activated');
	}

	/**
	 * It just provides rendering view
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function activateFailed(){
		return view('auth.invalid');
	}
}
