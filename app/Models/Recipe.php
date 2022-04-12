<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
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
        'description',
        'eta',
        'plates',
        'suggested_drinks'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'json',
        'suggested_drinks' => 'json'
    ];

    /**
     * Get the user associated with the recipe.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the recipes associated with the ingredient.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient');
    }
}
