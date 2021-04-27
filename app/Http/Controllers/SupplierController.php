<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    	$supplier = Supplier::all();
        return view('supplier.index', ['supplier' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = new Supplier();
	    $supplier->name = $request->input('name');
	    $supplier->address = $request->input('address');
	    $supplier->phone = $request->input('phone');
	    $supplier->save();
	
	    Alert::toast('Item Added Successfully!', 'success')->position('top-end');
	    return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit')->with(['supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
	    $supply = Supplier::find($id);
	    $supply->name = $request->input('name');
	    $supply->address = $request->input('address');
	    $supply->phone = $request->input('phone');
	    $supply->save();
	
	    Alert::success('Item Updated', 'success');
	    return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
	    toast('Vendor Deleted', 'success');
	    return back();
    }
}
