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
			'file'       => 'nullable|mimes:pdf,jpg,png,jpeg',
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

		if ($request->hasFile('file')) {
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
		$this->validate($request, [
			'unit'       => 'required',
			'unit_price' => 'required',
			'amount'     => 'required',
			'file'       => 'nullable|mimes:pdf,jpg,png,jpeg',
			'qc_report'  => 'string',
		]);
		
		//get current amount and cost from raws table
		$currentAmount = $ingredient->raw->amount;
		$currentCost = $ingredient->raw->cost;
		
		$oldAmount = $ingredient->amount;
		$oldCost = $ingredient->amount * $ingredient->unit_price;
		
		$ingredient->update([
			'raw_id'      => $request->raw,
			'supplier_id' => $request->supplier,
			'user_id'     => auth()->user()->id,
			'unit'        => $request->unit,
			'unit_price'  => $request->unit_price,
			'amount'      => $request->amount,
			'file'        => $request->file,
			'qc_report'   => $request->qc_report,
		]);
		
		$currentRawItem = $ingredient->raw;
		
		$newAmount = $request->amount;
		$newCost = $newAmount * $request->unit_price;

		$finalAmount = ($currentAmount - $oldAmount) + $newAmount;
		$finalCost = ($currentCost - $oldCost) + $newCost;

		// updating the table
		$currentRawItem->update([
			'amount' => $finalAmount,
			'cost' => $finalCost
		]);
	
		if ($request->hasFile('file')) {
			$ingredient->addMedia($request->file)->toMediaCollection('file');
		}
		alert()->success('Done!', 'Entry Updated successfully');
		
		return redirect()->route('ingredient.index');
	}
	
	//approve
	public function approve(Ingredient $id)
	{

		$currentRawItem = Raw::find($id->raw_id);
		$currentRawAmount = $currentRawItem->amount; // getting the existing amount from the table
		
		
		$newRawAmount = $id->amount;
		$amountToShow = $currentRawAmount + $newRawAmount; // total amount to be added to the table
		
		$currentCost = $currentRawItem->cost; // getting the existing cost from the table
		
		$newCost = $id->amount * $id->unit_price; // calculating the total cost
		
		$costToShow = $currentCost + $newCost; // total cost to be added to the table
		
		// updating the table
		$currentRawItem->update([
			'amount' => $amountToShow,
			'cost' => $costToShow
		]);
		if (!$id->is_approved) {
			$id->is_approved = true;
			$id->save();
			alert()->success('Approved', 'The entry is approved successfully');
		} else {
			alert()->info('This entry is already approved');
		}
		
		return back();
	}
	
	public function destroy(Ingredient $ingredient)
	{
		$ingredient->delete();
		toast('Entry Deleted', 'success');
		
		return back();
	}
}
