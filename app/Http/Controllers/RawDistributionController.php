<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Raw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RawDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
	    Gate::authorize('app.dist.create');
    	$raws = Raw::all();
        return view('distribution.raw',compact('raws'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
	    Gate::authorize('app.dist.create');
	    $rawItem = Raw::find($request->raw);
	    
	    $this->validate($request, [
		    'unit_price' => 'required|numeric',
		    'amount'   => 'required|numeric|max:'.$rawItem->amount,
		    'buyer_name' => 'required|string|max:255',
		    'buyer_address' => 'required',
		    'buyer_phone' => 'required'
	    ]);
	
	    $distribution = Distribution::create([
		    'raw_id' => $request->raw,
		    'unit_price' => $request->unit_price,
		    'amount' => $request->amount,
		    'buyer_name' => $request->buyer_name,
		    'buyer_address' => $request->buyer_address,
		    'buyer_phone' => $request->buyer_phone,
	    ]);
	    
	    //update raw amount
	    $rawAmount = $rawItem->amount;
	    $soldAmount = $request->amount;
	    $newRawAmount = $rawAmount - $soldAmount;
	    $rawItem->update([
	    	'amount' => $newRawAmount
	    ]);
	
	    alert()->success('Done!', 'Distribution Created Successfully');
	    return redirect()->route('distribution.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
	    Gate::check('app.dist.index');
	    $rawItem = Distribution::find($id);
	    return view('distribution.show-raw', compact('rawItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
	    Gate::check('app.dist.edit');
	    $distribution = Distribution::find($id);
	    $raws = Raw::all();
	    return view('distribution.raw', compact('distribution', 'raws'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
	    Gate::check('app.dist.edit');
	    $rawDist = Distribution::find($id);
	    $rawItem = $rawDist->raw;
	    
	    
	    $this->validate($request, [
		    'unit_price' => 'required|numeric',
		    'amount'   => 'required|numeric|max:'.$rawItem->amount,
		    'buyer_name' => 'required|string|max:255',
		    'buyer_address' => 'required',
		    'buyer_phone' => 'required'
	    ]);

	    $rawAmount = $rawItem->amount;
	    $oldRawAmount = $rawDist->amount;
	    $newRawAmount = $request->amount;

	    $finalAmount = ($rawAmount + $oldRawAmount) - $newRawAmount;

	    $rawItem->update([
		    'amount' => $finalAmount
	    ]);

	    $rawDist->update([
		    'raw_id' => $rawItem->id,
		    'unit_price' => $request->unit_price,
		    'amount' => $request->amount,
		    'buyer_name' => $request->buyer_name,
		    'buyer_address' => $request->buyer_address,
		    'buyer_phone' => $request->buyer_phone
	    ]);

	    alert()->success('Done!', 'Updated successfully');
	    return redirect()->route('distribution.index');
	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $distribution = Distribution::find($id);
	    $distribution->delete();
	    alert()->success('Deleted!');
	    return back();
    }
}
