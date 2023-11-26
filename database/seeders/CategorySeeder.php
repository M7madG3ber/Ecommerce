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
        /**
         * Run first time if table is empty
         */

        $categoriesCount = Category::count();

        if ($categoriesCount == 0) {
            Category::insert([
                ['name' => 'Cloths'],
                ['name' => 'Shoes'],
                ['name' => 'Books'],
                ['name' => 'Elctonics']
            ]);
        }
    }
}
