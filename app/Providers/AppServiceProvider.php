<?php

namespace App\Providers;

use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class   AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
	
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
//		Schema::defaultStringLength(191);
		
		View::share('pendingCount', Ingredient::whereIsApproved(0)->count());
		
		// custom blade for role check
		Blade::if('role', function ($role) {
			return Auth::user()->role->slug == $role;
		});
	}
}
