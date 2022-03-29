<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $user_id, $name, $quantity;
        return [
            'user_id' => $user_id ?: User::all()->random()->id,
            'name' => $name ?: $this->faker->catchPhrase(),
            'quantity' => $quantity ?: rand(100, 999) / 10
        ];
    }
}
