<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'category_name' => 'Resume',
            'accepted_type' => 'pdf, doc, docx',
        ]);

        Category::create([
            'id' => 2,
            'category_name' => 'Agreement',
            'accepted_type' => 'pdf, doc, docx',
        ]);

        Category::create([
            'id' => 3,
            'category_name' => 'Photo',
            'accepted_type' => 'jpg, jpeg, png',
        ]);

    }
}
