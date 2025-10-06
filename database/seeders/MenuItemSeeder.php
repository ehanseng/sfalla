<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::create(['title' => 'Biografía', 'url' => '/', 'order' => 1]);
        MenuItem::create(['title' => 'Coaching', 'url' => '/seccion/coaching', 'order' => 2]);
        MenuItem::create(['title' => 'Van Life', 'url' => '/seccion/van-life', 'order' => 3]);
        MenuItem::create(['title' => 'Skydiving', 'url' => '/seccion/skydiving', 'order' => 4]);
        MenuItem::create(['title' => 'Viajes', 'url' => '/seccion/viajes', 'order' => 5]);
        MenuItem::create(['title' => 'Contacto', 'url' => '/contacto', 'order' => 6]);
    }
}
