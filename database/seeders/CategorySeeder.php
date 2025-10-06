<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Timeline Categories
        Category::create(['name' => 'Tenis (Jugador)', 'slug' => Str::slug('Tenis (Jugador)'), 'type' => 'timeline']);

        // Post Categories
        Category::create(['name' => 'Coaching', 'slug' => Str::slug('Coaching'), 'type' => 'post']);
        Category::create(['name' => 'Van Life', 'slug' => Str::slug('Van Life'), 'type' => 'post']);
        Category::create(['name' => 'Skydiving', 'slug' => Str::slug('Skydiving'), 'type' => 'post']);
        Category::create(['name' => 'Viajes', 'slug' => Str::slug('Viajes'), 'type' => 'post']);
    }
}
