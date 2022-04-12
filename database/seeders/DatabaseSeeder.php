<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'Alexandru Florea',
            'email' => 'alexandru.florea@staff.utcluj.ro',
            'password' => Hash::make('password'),
        ]);
        User::factory(10)->create();
        Ingredient::factory(100)->create();
        Recipe::factory(25)->create();

        $ingredients = Ingredient::select(['id'])->orderBy('id', 'DESC')->take(5)->get();
        $recipes = Recipe::all();
        foreach ($recipes as $recipe) {
            $recipe->ingredients()->syncWithoutDetaching($ingredients);
        }
    }
}
