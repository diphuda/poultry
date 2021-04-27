<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredient.index', compact('ingredients'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }
    
    public function show(Ingredient $ingredient)
    {
        //
    }
    
    public function edit(Ingredient $ingredient)
    {
        //
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
