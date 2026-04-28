<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Web Development',      'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Mobile Development',   'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Data Science',         'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'UI/UX Design',         'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Cybersecurity',        'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Cloud Computing',      'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('product_categories')->insert($categories);
    }
}