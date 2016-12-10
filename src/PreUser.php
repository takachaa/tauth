<?php

namespace Takachaa\Tauth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * PreUser is the data structure for registration form data.
 * It is used by the 'register' action of 'TRegisterController'
 * and 'activateAccount' action of 'TActivateController'
 */
class PreUser extends Authenticatable
{
	use Notifiable;

	protected $table = 'pre_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'activation_token','confirmed'
	];

	/**
	 * Create activation Token and set property
	 *
	 * @return void
	 */
	public function setActivationToken()
	{
		$this->activation_token = Str::random(60);
	}

	/**
	 * Send the activating account notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendActivationNotification($token)
	{
		$this->notify(new ActivateNotification($token));
	}
}
