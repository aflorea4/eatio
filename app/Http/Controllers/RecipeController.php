<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->recipes ?? [];
    }

    public function show(Recipe $recipe)
    {
        return $recipe;
    }
}
