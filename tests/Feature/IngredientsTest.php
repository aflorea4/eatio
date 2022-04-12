<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientsTest extends TestCase
{
    /**
     * Test that the index page of ingredients can be accessed.
     *
     * @return void
     */
    public function test_ingredients_index_page_can_be_accessed()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/ingredients');

        $response->assertStatus(200);
    }

    /**
     * Test that the index page of recipes can be accessed.
     *
     * @return void
     */
    public function test_a_single_ingredient_page_can_be_accessed()
    {
        $this->actingAs($user = User::factory()->create());
        $ingredient = Ingredient::factory()->make([
            'user_id' => $user->id
        ]);

        $response = $this->get('/ingredients/' . $ingredient->id);

        $response->assertStatus(200);
    }

    /**
     * Test that the recipe model can be created correctly.
     *
     * @return void
     */
    public function test_recipe_model_can_be_created_correctly()
    {
        $this->actingAs($user = User::factory()->create());
        $ingredient = Ingredient::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test Recipe',
            'quantity' => 90.00,
        ]);

        $this->assertDatabaseHas(
            'ingredients',
            [
                'user_id' => $user->id,
                'name' => 'Test Recipe',
                'quantity' => 90.00,
            ]
        );
    }
}
