<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Cabos'],
            ['name' => 'Canaletas'],
            ['name' => 'Conectores'],
            ['name' => 'Disjuntores'],
            ['name' => 'Eletrodutos'],
            ['name' => 'Fios'],
            ['name' => 'Fitas'],
            ['name' => 'Notebooks'],
            ['name' => 'Painéis'],
            ['name' => 'Pilhas'],
            ['name' => 'Placas'],
            ['name' => 'Eletronicos'],
            ['name' => 'Tomadas'],
            ['name' => 'Transformadores'],
            ['name' => 'Ventiladores'],
            ['name' => 'Motores Eletricos'],
            ['name' => 'Lampadas'],
            ['name' => 'Luminarias'],
            ['name' => 'Ferramentas'],
            ['name' => 'Eletrodomesticos'],
            ['name' => 'Eletroportateis'],
            ['name' => 'Papelaria'],
            ['name' => 'Materiais de Limpeza'],
            ['name' => 'Materiais de Escritorio'],
            ['name' => 'Materiais de Informatica'],
            ['name' => 'Som'],
            ['name' => 'Video'],
            ['name' => 'Educação'],
            ['name' => 'Marketing'],
            ['name' => 'Comunicação'],
            ['name' => 'Serviços'],
            ['name' => 'Outros']
        ]);
    }
}
