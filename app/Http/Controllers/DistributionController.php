<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DistributionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 */
	public function index()
	{
		//Gate::authorize('app.dist.index');
		$rawdist = Distribution::whereFeedId(null)->with('raw')->orderBy('created_at', 'DESC')->get();
		$feedDist = Distribution::whereRawId(null)->with('feed')->orderBy('created_at', 'DESC')->get();
		
		return view('distribution.index', compact('feedDist', 'rawdist'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 */
	public function create()
	{
		Gate::authorize('app.dist.create');
		$feeds = Feed::all();
		
		return view('distribution.form', compact('feeds'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 */
	public function store(Request $request)
	{
		Gate::authorize('app.dist.create');
		$feedItem = Feed::find($request->feed);
		
		$this->validate($request, [
			'unit_price'    => 'required|numeric',
			'amount'        => 'required|numeric|max:' . $feedItem->amount,
			'buyer_name'    => 'required|string|max:255',
			'buyer_address' => 'required',
			'buyer_phone'   => 'required'
		]);
		
		$distribution = Distribution::create([
			'feed_id'       => $request->feed,
			'unit_price'    => $request->unit_price,
			'amount'        => $request->amount,
			'buyer_name'    => $request->buyer_name,
			'buyer_address' => $request->buyer_address,
			'buyer_phone'   => $request->buyer_phone,
		]);
		
		//update feed amount
		$feedAmount = $feedItem->amount;
		$distributedAmount = $request->amount;
		$newFeedAmount = $feedAmount - $distributedAmount;
		
		$feedItem->update([
			'amount' => $newFeedAmount
		]);
		
		alert()->success('Done!', 'Distribution Created Successfully');
		
		return redirect()->route('distribution.index');
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 */
	public function show(Distribution $distribution)
	{
		Gate::check('app.dist.index');
		
		return view('distribution.show', compact('distribution'));
		//        return $distribution;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 */
	public function edit(Distribution $distribution)
	{
		Gate::check('app.dist.edit');
		$feeds = Feed::all();
		
		return view('distribution.form', compact('distribution', 'feeds'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 */
	public function update(Request $request, Distribution $distribution)
	{
		Gate::check('app.dist.edit');
		
		$feedItem = Feed::find($distribution->feed->id);
		
		$this->validate($request, [
			'unit_price'    => 'required|numeric',
			'amount'        => 'required|numeric|max:' . $feedItem->amount,
			'buyer_name'    => 'required|string|max:255',
			'buyer_address' => 'required',
			'buyer_phone'   => 'required'
		]);
		
		$feedAmount = $feedItem->amount;
		$oldFeedAmount = $distribution->amount;
		$newFeedAmount = $request->amount;
		
		$finalAmount = ($feedAmount + $oldFeedAmount) - $newFeedAmount;
		
		$feedItem->update([
			'amount' => $finalAmount
		]);
		
		$distribution->update([
			'feed_id'       => $feedItem->id,
			'unit_price'    => $request->unit_price,
			'amount'        => $request->amount,
			'buyer_name'    => $request->buyer_name,
			'buyer_address' => $request->buyer_address,
			'buyer_phone'   => $request->buyer_phone
		]);
		
		alert()->success('Done!', 'Updated successfully');
		
		return redirect()->route('distribution.index');
		
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Distribution $distribution
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Distribution $distribution)
	{
		$distribution->delete();
		alert()->success('Deleted!');
		
		return back();
	}
}
