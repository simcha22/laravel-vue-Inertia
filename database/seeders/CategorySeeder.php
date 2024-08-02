<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'squats']);
        Category::create(['name' => 'cleans']);
        Category::create(['name' => 'presses']);
        Category::create(['name' => 'jerks']);
        Category::create(['name' => 'snatches']);
        Category::create(['name' => 'deadlifts']);
        Category::create(['name' => 'olimpic lifts']);
        Category::create(['name' => 'other']);

    }
}
