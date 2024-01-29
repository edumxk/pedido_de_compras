<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'description' => 'Notebook Dell Inspiron 15 3000',
                'brand' => 'Dell',
                'category_id' => 7,
                'created_at' => now(),
            ],
            [
                'description' => 'Notebook Dell Vostro 3210',
                'brand' => 'Dell',
                'category_id' => 7,
                'created_at' => now(),
            ],
            [
                'description' => 'Lampada Led 50w',
                'brand' => 'Philips',
                'category_id' => 17,
                'created_at' => now(),
            ],
            [
                'description' => 'Monitor Dell 15 polegadas',
                'brand' => 'Dell',
                'category_id' => 27,
                'created_at' => now(),
            ],


        ]);
    }
}
