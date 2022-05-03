<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Ingredients/Index', [
            'ingredients' => $request->user()->ingredients,
        ]);
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->update($request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
        ]));

        return redirect()->route('ingredients.index');
    }

    public function destroy(Request $request, Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index');
    }

    public function store(Request $request)
    {
        $request->user()->ingredients()->create($request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
        ]));

        return redirect()->route('ingredients.index');
    }
}
