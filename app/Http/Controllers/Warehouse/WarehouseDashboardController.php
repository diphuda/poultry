<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WarehouseDashboardController extends Controller
{
    public function index(){
	    Gate::authorize('warehouse-dashboard');
    	return view('warehouse.dashboard');
    }
}
