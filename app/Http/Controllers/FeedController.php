<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Raw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $feeds = Feed::orderBy('created_at', 'DESC')->get();
        return view('feed.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
	    Gate::authorize('app.feed.create');
	    $raws = Raw::all()->where('amount', '>', 0);
        return view('feed.form', compact('raws'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
	    Gate::authorize('app.feed.create');

	    $raws = Raw::all()->where('amount', '>', 0);
	    $wastage = $request->wastage;
	
	    $this->validate($request, [
	    	'name' => 'required|string',
		    'wastage' => 'numeric|max:99',
		    'flock' => 'required',
	    ]);

	    $totalFeedAmount = 0;
	    $totalFeedCost = 0;
	    
	    foreach ($raws as $raw){
	    
	    	$this->validate($request, [
			    $raw->id.'-amount' => 'nullable|numeric|max:'.$raw->amount,
		    ]);

	    	$inputtedAmount = $request->all()[$raw->id.'-amount'];
		    $newRawAmount = $raw->amount - $inputtedAmount;
		    $avgRawCost = $raw->cost / $raw->total_purchased_amount;
		    $amountWithWastage = $inputtedAmount - ($inputtedAmount* ($wastage / 100));
		    $rawCost = $inputtedAmount * $avgRawCost;
		    $finalCost = $rawCost + ($rawCost * (($wastage / 100)));
		
		    $totalFeedAmount += $amountWithWastage;
		    $totalFeedCost += $finalCost;
		    
		    $raw->update([
		    	'amount' => $newRawAmount,
		    ]);
	    }
	    
	    // store to feeds table
	    $feed = Feed::create([
	    	'name' => $request->name,
		    'wastage' => $request->wastage,
		    'amount' => $totalFeedAmount,
		    'total_amount' => $totalFeedAmount,
		    'flock' => $request->flock,
		    'project_name' => $request->project_name,
		    'cost' => $totalFeedCost
	    ]);
	
	    Alert::toast('Feed Made Successfully!', 'success')->position('top-end');
	    return redirect()->route('feed.index');
	   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(Feed $feed)
    {
	    Gate::authorize('app.feed.destroy');

	    $feed->delete();
	    alert()->success('Deleted!', 'The item is deleted successfully');
	    return back();
    }
}
