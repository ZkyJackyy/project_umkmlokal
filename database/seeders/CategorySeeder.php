<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zacky_categories')->insert([
            [
            'category_name' => 'makanan',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
                'category_name' => 'minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'kerajinan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'kecantikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'fashion',
                'created_at' => now(),
                'updated_at' => now(),
                ],
        ]);
    }
}
