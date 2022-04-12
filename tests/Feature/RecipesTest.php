<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipesTest extends TestCase
{
    /**
     * Test that the index page of recipes can be accessed.
     *
     * @return void
     */
    public function test_recipes_index_page_can_be_accessed()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/recipes');

        $response->assertStatus(200);
    }

    /**
     * Test that the index page of recipes can be accessed.
     *
     * @return void
     */
    public function test_a_single_recipe_page_can_be_accessed()
    {
        $this->actingAs($user = User::factory()->create());
        $recipe = Recipe::factory()->make([
            'user_id' => 1
        ]);

        $response = $this->get('/recipes/' . $recipe->id);

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
        $recipe = Recipe::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test Recipe',
            'description' => 'This is a test recipe',
            'eta' => '30',
            'plates' => '2',
            'suggested_drinks' => '["test drink"]',
        ]);

        $this->assertDatabaseHas('recipes', [
            'user_id' => $user->id,
            'name' => 'Test Recipe',
            'description' => 'This is a test recipe',
            'eta' => '30',
            'plates' => '2',
            'suggested_drinks' => '["test drink"]',
        ]);
    }
}
