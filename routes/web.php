<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index')->middleware(['auth:sanctum']);
Route::post('/ingredients/{ingredient:id}/update', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{ingredient:id}/delete', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
Route::get('/ingredients/{ingredient:id}', [IngredientController::class, 'show'])->name('ingredients.show')->middleware(['auth:sanctum']);;
Route::post('/ingredients/create', [IngredientController::class, 'store'])->name('ingredients.store')->middleware(['auth:sanctum']);;
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index')->middleware(['auth:sanctum']);;
Route::get('/recipes/{recipe:id}', [RecipeController::class, 'show'])->name('recipes.show')->middleware(['auth:sanctum']);;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
