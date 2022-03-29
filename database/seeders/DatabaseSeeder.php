<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
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
    }
}
