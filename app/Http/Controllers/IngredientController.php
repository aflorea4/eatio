<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->ingredients() ?? [];
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
    }
}
