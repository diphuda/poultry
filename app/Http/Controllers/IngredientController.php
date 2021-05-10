<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Ingredient;
use App\Models\Raw;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class IngredientController extends Controller
{
	public function index()
	{
		Gate::authorize('app.entry.index');
		$ingredients = Ingredient::with('supplier', 'raw')->orderBy('created_at', 'DESC')->get();
		
		return view('ingredient.index', compact('ingredients'));
	}
	
	public function create()
	{
		Gate::authorize('app.entry.create');
		$raws = Raw::all();
		$suppliers = Supplier::all();
		
		return view('ingredient.form', compact(['raws', 'suppliers']));
	}
	
	
	public function store(Request $request)
	{
		Gate::authorize('app.entry.create');
		$this->validate($request, [
			'unit'       => 'required',
			'unit_price' => 'required|numeric',
			'amount'     => 'required|numeric',
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
		Gate::authorize('app.entry.index');
		
		return view('ingredient.show', compact('ingredient'));
	}
	
	
	public function edit(Ingredient $ingredient)
	{
		Gate::authorize('app.entry.edit');
		$raws = Raw::all();
		$suppliers = Supplier::all();
		
		return view('ingredient.form', compact(['raws', 'suppliers', 'ingredient']));
	}
	
	
	public function update(Request $request, Ingredient $ingredient)
	{
		Gate::authorize('app.entry.edit');
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
		
		//check only approved entry can add data to raws table
		if ($ingredient->is_approved) {
			$currentRawItem = $ingredient->raw;
			
			$newAmount = $request->amount;
			$newCost = $newAmount * $request->unit_price;
			
			$currentTotalAmount = $currentRawItem->total_purchased_amount;
			
			$finalAmount = ($currentAmount - $oldAmount) + $newAmount;
			$finalCost = ($currentCost - $oldCost) + $newCost;
			$newTotalAmount = $currentTotalAmount + $newAmount;
			
			// updating the table
			$currentRawItem->update([
				'amount'                 => $finalAmount,
				'cost'                   => $finalCost,
				'total_purchased_amount' => $newTotalAmount
			]);
		}
		
		if ($request->hasFile('file')) {
			$ingredient->addMedia($request->file)->toMediaCollection('file');
		}
		
		alert()->success('Done!', 'Entry Updated successfully');
		
		return redirect()->route('ingredient.index');
	}
	
	
	public function pending()
	{
		Gate::authorize('app.entry.approve');
		$ingredients = Ingredient::with('raw', 'supplier')->whereIsApproved(0)->orderBy('created_at', 'DESC')->get();
		
		return view('ingredient.pending', compact('ingredients'));
	}
	
	//approve
	public function approve(Ingredient $id)
	{
		Gate::authorize('app.entry.approve');
		$currentRawItem = Raw::find($id->raw_id);
		$currentRawAmount = $currentRawItem->amount; // getting the existing AVAILABLE amount from the table
		$currentTotalAmount = $currentRawItem->total_purchased_amount; // getting the total purchased amount
		
		
		$newRawAmount = $id->amount;
		$amountToShow = $currentRawAmount + $newRawAmount; // total amount to be added to the table
		$totalPurchased = $currentTotalAmount + $newRawAmount;
		
		$currentCost = $currentRawItem->cost; // getting the existing cost from the table
		
		$newCost = $id->amount * $id->unit_price; // calculating the total cost
		
		$costToShow = $currentCost + $newCost; // total cost to be added to the table
		
		// updating the table
		if ($currentRawAmount) {
			$currentRawItem->update([
				'amount'                 => $amountToShow,
				'cost'                   => $costToShow,
				'total_purchased_amount' => $totalPurchased
			]);
		}
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
		Gate::authorize('app.entry.destroy');
		if ($ingredient->is_approved) {
			$remainingAmount = $ingredient->raw->amount - $ingredient->amount;
			$currentCost = $ingredient->amount * $ingredient->unit_price;
			$remainingCost = $ingredient->raw->cost - $currentCost;
			$currentRawItem = $ingredient->raw;
			$currentRawItem->update([
				'amount' => $remainingAmount,
				'cost'   => $remainingCost
			]);
		}
		
		$ingredient->delete();
		alert()->success('Deleted!', 'The entry is deleted successfully');
		
		return back();
	}
}
