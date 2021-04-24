<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupervisorDashboardController extends Controller
{
    public function index(){
	    Gate::authorize('supervisor-dashboard');
    	return view('supervisor.dashboard');
    }
}
