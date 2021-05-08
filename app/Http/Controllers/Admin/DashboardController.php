<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Feed;
use App\Models\Ingredient;
use App\Models\Raw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
	    Gate::authorize('app.dashboard');
	    $ingredients = Ingredient::with('supplier', 'raw')->orderBy('created_at', 'DESC')->get();
	    $sumUnitPrice = $ingredients->sum('unit_price');
	    $sumAmount = $ingredients->sum('amount');
	    $totalCost = $sumUnitPrice * $sumAmount;
	    $item = Raw::all();
	    $feeds = Feed::all();
	    $distribution = Distribution::all();
    	return view('admin.dashboard', compact('ingredients','item','feeds','distribution', 'totalCost', 'sumAmount'));
    }
}
