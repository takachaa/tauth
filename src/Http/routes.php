<?php

Route::group(['middleware' => ['web']], function () {
	Route::get('register', 'Takachaa\Tauth\Http\Controllers\TRegisterController@showRegistrationForm');
	Route::post('register', 'Takachaa\Tauth\Http\Controllers\TRegisterController@register');
	Route::get('register/complete', 'Takachaa\Tauth\Http\Controllers\TRegisterController@registerComplete');

	Route::get('activate/complete','Takachaa\Tauth\Http\Controllers\TActivateController@activateComplete');
	Route::get('activate/error','Takachaa\Tauth\Http\Controllers\TActivateController@activateFailed');
	Route::get('activate/{token}', 'Takachaa\Tauth\Http\Controllers\TActivateController@activateAccount');

	Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
	Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

	Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
	Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
	Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

	Route::get('home', 'Takachaa\Tauth\Http\Controllers\THomeController@index');
});