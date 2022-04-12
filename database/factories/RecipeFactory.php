<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $generated_description = [
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
        ];

        $available_drinks = [
            'Coca Cola',
            'Orange Juice',
            'Lemonade',
            'Whisky',
            'Matcha Latte',
            'Cuba Libre',
            'Coffee',
            'Wine',
            'Pina Colada',
            'Beer',
            'Cocktail',
            'Sangria',
            'Coconut Water',
        ];

        $generated_suggested_drinks = [
            $this->faker->randomElement($available_drinks),
            $this->faker->randomElement($available_drinks),
            $this->faker->randomElement($available_drinks),
            $this->faker->randomElement($available_drinks),
        ];

        $generated_description = [
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
            $this->faker->catchPhrase(),
        ];

        static $user_id, $name, $description, $eta, $plates, $suggested_drinks;
        return [
            'user_id' => $user_id ?: (User::all()->isNotEmpty() ? User::all()->random()->id : null),
            'name' => $name ?: $this->faker->catchPhrase(),
            'description' => $description ?: $generated_description,
            'eta' => $eta ?: $this->faker->numberBetween(0, 120),
            'plates' => $plates ?: $this->faker->numberBetween(0, 10),
            'suggested_drinks' => $suggested_drinks ?: $generated_suggested_drinks
        ];
    }
}
