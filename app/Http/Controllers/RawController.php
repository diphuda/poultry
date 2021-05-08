<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Raw;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Raw::all();
        return view('raw.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('raw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:raws',
            'item_code' => 'required|unique:raws',
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
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Raw::findOrfail($id);
        return view('raw.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
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
     */
    public function destroy($id)
    {
        // example:
        alert()->success('Deleted', 'Raw Item Deleted Successfully.')->showConfirmButton('OK', '#3085d6');
        $item = Raw::findOrFail($id);
        $item->delete();
        return redirect()->route('raw-item.index');
    }
}
