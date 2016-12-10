<?php

namespace Takachaa\Tauth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * THomeController is the Controller for providing provisional home pages after login.
 * This is almost HomeController. But HomeController is inactive in default.
 * That's why I created in my package.
 */
class THomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('home');
	}
}