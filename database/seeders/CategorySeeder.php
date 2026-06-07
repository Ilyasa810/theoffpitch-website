<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Premier League', 'slug' => 'premier-league'],
            ['name' => 'La Liga', 'slug' => 'la-liga'],
            ['name' => 'Serie A', 'slug' => 'serie-a'],
            ['name' => 'Bundesliga', 'slug' => 'bundesliga'],
            ['name' => 'Ligue 1', 'slug' => 'ligue-1'],
            ['name' => 'Timnas Indonesia', 'slug' => 'timnas-indonesia'],
            ['name' => 'Transfer Window', 'slug' => 'transfer-window'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}