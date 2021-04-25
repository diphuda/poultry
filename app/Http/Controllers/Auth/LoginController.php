<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	*/
	
	use AuthenticatesUsers;
	
	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
//	protected $redirectTo;
	    protected $redirectTo = RouteServiceProvider::HOME;
	
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		if (Auth::check() && Auth::user()->role->id == 1) {
			return redirect()->route('admin.dashboard');
		} elseif (Auth::check() && Auth::user()->role->id == 2) {
			return redirect()->route('supervisor.dashboard');
		} elseif (Auth::check() && Auth::user()->role->id == 3) {
			return redirect()->route('warehouse.dashboard');
		}
		$this->middleware('guest')->except('logout');
	}
}
