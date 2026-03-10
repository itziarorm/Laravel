<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ingredient::with("potions")->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ingredient_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'rarity' => 'required|integer|min:1'
        ]);

        return Ingredient::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Ingredient::with('potions')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());

        return $ingredient;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ingredient::destroy($id);
        return response()->json(['message' => 'Ingredient deleted']);
    }
}
