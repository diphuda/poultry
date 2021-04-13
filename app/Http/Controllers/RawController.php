<?php

namespace App\Http\Controllers;

use App\Models\Raw;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RawController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function index()
	{
		$item = Raw::all();
		
		return view('raw.index', ['item' => $item]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function create()
	{
		return view('raw.create');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name'      => 'required',
			'item_code' => 'required',
		]);
		
		$item = new Raw();
		$item->name = $request->input('name');
		$item->item_code = $request->input('item_code');
		
		$item->save();

			    Alert::toast('Item Added Successfully!', 'success')->position('top-end');
		return redirect()->route('raw-item.index');
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$item = Raw::findOrfail($id);
		return view('raw.edit')->with('item', $item);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id)
	{
		$item = Raw::find($id);
		$item->name = $request->input('name');
		$item->item_code = $request->input('item_code');
		
		$item->save();
		
		Alert::success('Item Updated', 'success');
		return redirect()->route('raw-item.index');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		// example:
		alert()->success('Deleted','Raw Item Deleted Successfully.')->showConfirmButton('Confirm', '#3085d6');
//		alert()->question('Are you sure?','You won\'t be able to revert this!')
//			->showConfirmButton('Yes! Delete it', '#3085d6')
//			->showCancelButton('Cancel', '#aaa')->reverseButtons();
		$item = Raw::findOrFail($id);
		$item->delete();
		return redirect()->route('raw-item.index');
	}
}
