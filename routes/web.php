<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\RawController;
use App\Http\Controllers\RawEntryController;
use App\Http\Controllers\Supervisor\SupervisorDashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Warehouse\WarehouseDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
	return view('welcome');
});
Route::get('/login', function () {
	return view('auth.login');
});

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	
	//	Route::get('dashboard', 'SupervisorDashboardController@index')->name('dashboard');
	Route::get('/dashboard', [DashboardController::class, 'index'])
		->name('dashboard');
	Route::resource('roles', RoleController::class);
});


Route::group(['as' => 'supervisor.', 'prefix' => 'supervisor', 'namespace' => 'Supervisor', 'middleware' => ['auth', 'supervisor']], function () {
	
	//	Route::get('dashboard', 'SupervisorDashboardController@index')->name('dashboard');
	Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])
		->name('dashboard');
});

Route::group(['as' => 'warehouse.', 'prefix' => 'warehouse', 'namespace' => 'Warehouse', 'middleware' => ['auth', 'warehouse']], function () {
	
	Route::get('/dashboard', [WarehouseDashboardController::class, 'index'])
		->name('dashboard');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('raw-item', RawController::class);
	Route::resource('raw-entry', RawEntryController::class);
//	Route::resource('ingredient', ::class);
	Route::resource('supplier', SupplierController::class);
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

