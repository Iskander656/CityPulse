<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Road Damage',
            'description' => 'Potholes, damaged roads and deteriorated road surfaces.',
        ]);

        Category::create([
            'name' => 'Street Lighting',
            'description' => 'Broken streetlights and public lighting failures.',
        ]);

        Category::create([
            'name' => 'Traffic Signals',
            'description' => 'Malfunctioning traffic lights and signal systems.',
        ]);

        Category::create([
            'name' => 'Road Obstructions',
            'description' => 'Objects or obstacles blocking public roads.',
        ]);

        Category::create([
            'name' => 'Waste Management',
            'description' => 'Overflowing waste containers and waste disposal problems.',
        ]);

        Category::create([
            'name' => 'Public Infrastructure',
            'description' => 'Damaged public facilities and urban infrastructure.',
        ]);
    }
}