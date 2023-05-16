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
        Category::create(['name' => 'Category 1']);
        Category::create(['name' => 'Category 2']);
        Category::create(['name' => 'Category 3']);
        Category::create(['name' => 'Category 1.1', 'parent_id' => 1]);
        Category::create(['name' => 'Category 1.2', 'parent_id' => 1]);
        Category::create(['name' => 'Category 1.1.1', 'parent_id' => 4]);
        Category::create(['name' => 'Category 1.1.2', 'parent_id' => 4]);
        Category::create(['name' => 'Category 2.1', 'parent_id' => 2]);
        Category::create(['name' => 'Category 2.2', 'parent_id' => 2]);
        Category::create(['name' => 'Category 2.3', 'parent_id' => 2]);
        Category::create(['name' => 'Category 2.1.1', 'parent_id' => 8]);
        Category::create(['name' => 'Category 2.1.2', 'parent_id' => 8]);
    }
}
