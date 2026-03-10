<?php

namespace App\Http\Controllers;

use App\Models\Potion;
use Illuminate\Http\Request;

class WizardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Wizard::with("potions", "ingredients")->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'magic_level' => 'required|integer|min:1'
        ]);

        return Wizard::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Wizard::with('potions', 'ingredients')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wizard = Wizard::findOrFail($id);
        $wizard->update($request->all());

        return $wizard;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Wizard::destroy($id);
        return response()->json(['message' => 'Wizard deleted']);
    }
}
