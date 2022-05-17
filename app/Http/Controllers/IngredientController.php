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
        $this->authorize('view', $ingredient);
        return Inertia::render('Ingredients/Show', [
            'ingredient' => $ingredient->load([
                'recipes',
            ]),
        ]);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient);
        $ingredient->update($request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
        ]));

        return redirect()->route('ingredients.index');
    }

    public function destroy(Request $request, Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);
        if ($ingredient->recipes() != null) {
            $ingredient->recipes()->detach($ingredient->recipes->pluck('id'));
        }
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
