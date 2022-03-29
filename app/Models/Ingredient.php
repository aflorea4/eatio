<?php

namespace App\Models;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'quantity',
    ];

    /**
     * Get the user associated with the ingredient.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the recipes associated with the ingredient.
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients');
    }
}
