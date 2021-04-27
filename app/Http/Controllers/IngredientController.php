<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Raw;
use App\Models\Supplier;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
	public function index()
	{
		$ingredients = Ingredient::orderBy('created_at', 'DESC')->get();
		
		return view('ingredient.index', compact('ingredients'));
	}
	
	public function create()
	{
		$raws = Raw::all();
		$suppliers = Supplier::all();
		return view('ingredient.form', compact(['raws', 'suppliers']));
	}
	
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'unit'       => 'required',
			'unit_price' => 'required',
			'amount'     => 'required',
			'file'       => 'required|mimes:jpeg,bmp,png,gif,svg,pdf',
			'qc_report'  => 'string',
		]);
		
		$ingredient = Ingredient::create([
			'raw_id'      => $request->raw,
			'supplier_id' => $request->supplier,
			'user_id'     => auth()->user()->id,
			'unit'        => $request->unit,
			'unit_price'  => $request->unit_price,
			'amount'      => $request->amount,
			'file'        => $request->file,
			'qc_report'   => $request->qc_report,
		]);
		if ($request->hasFile('file')){
			$ingredient->addMedia($request->file)->toMediaCollection('file');
		}
		alert()->success('Done!', 'Entry Added successfully');
		
		return redirect()->route('ingredient.index');
	}
	
	public function show(Ingredient $ingredient)
	{
		return view('ingredient.show', compact('ingredient'));
	}
	
	public function edit(Ingredient $ingredient)
	{
		$raws = Raw::all();
		$suppliers = Supplier::all();
		return view('ingredient.form', compact(['raws', 'suppliers', 'ingredient']));
	}
	
	public function update(Request $request, Ingredient $ingredient)
	{
		//
	}
	
	public function destroy(Ingredient $ingredient)
	{
		$ingredient->delete();
		toast('Entry Deleted', 'success');
		
		return back();
	}
}
