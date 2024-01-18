<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'name' => 'Analista de TI',
                'description' => 'Analista e Desenvolvimento de Sistemas e Suporte',
                'department_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de RH',
                'description' => 'Analista de Recursos Humanos',
                'department_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de Marketing',
                'description' => 'Analista de Marketing',
                'department_id' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de Produção',
                'description' => 'Analista de Produção',
                'department_id' => 7,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de Logística',
                'description' => 'Analista de Logística',
                'department_id' => 8,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de Manutenção',
                'description' => 'Analista de Manutenção',
                'department_id' => 9,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de WMS',
                'description' => 'Analista de WMS',
                'department_id' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista de Comercial',
                'description' => 'Analista de Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Assistente Comercial',
                'description' => 'Assistente Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar Comercial',
                'description' => 'Auxiliar Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de TI',
                'description' => 'Gerente de TI',
                'department_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de RH',
                'description' => 'Gerente de RH',
                'department_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de Marketing',
                'description' => 'Gerente de Marketing',
                'department_id' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de Produção',
                'description' => 'Gerente de Produção',
                'department_id' => 7,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de Logística',
                'description' => 'Gerente de Logística',
                'department_id' => 8,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de Manutenção',
                'description' => 'Gerente',
                'department_id' => 9,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de WMS',
                'description' => 'Gerente de WMS',
                'department_id' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Gerente de Comercial',
                'description' => 'Gerente de Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de TI',
                'description' => 'Auxiliar de TI',
                'department_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de RH',
                'description' => 'Auxiliar de RH',
                'department_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de Marketing',
                'description' => 'Auxiliar de Marketing',
                'department_id' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de Produção',
                'description' => 'Auxiliar de Produção',
                'department_id' => 7,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de Logística',
                'description' => 'Auxiliar de Logística',
                'department_id' => 8,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de Manutenção',
                'description' => 'Auxiliar de Manutenção',
                'department_id' => 9,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de WMS',
                'description' => 'Auxiliar de WMS',
                'department_id' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Auxiliar de Comercial',
                'description' => 'Auxiliar de Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de TI',
                'description' => 'Estagiário de TI',
                'department_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de RH',
                'description' => 'Estagiário de RH',
                'department_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de Marketing',
                'description' => 'Estagiário de Marketing',
                'department_id' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de Produção',
                'description' => 'Estagiário de Produção',
                'department_id' => 7,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de Logística',
                'description' => 'Estagiário de Logística',
                'department_id' => 8,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de Manutenção',
                'description' => 'Estagiário de Manutenção',
                'department_id' => 9,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de WMS',
                'description' => 'Estagiário de WMS',
                'department_id' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Estagiário de Comercial',
                'description' => 'Estagiário de Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de TI',
                'description' => 'Diretor de TI',
                'department_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de RH',
                'description' => 'Diretor de RH',
                'department_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de Marketing',
                'description' => 'Diretor de Marketing',
                'department_id' => 6,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de Produção',
                'description' => 'Diretor de Produção',
                'department_id' => 7,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de Logística',
                'description' => 'Diretor de Logística',
                'department_id' => 8,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de Manutenção',
                'description' => 'Diretor de Manutenção',
                'department_id' => 9,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de WMS',
                'description' => 'Diretor de WMS',
                'department_id' => 10,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor de Comercial',
                'description' => 'Diretor de Comercial',
                'department_id' => 5,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor Financeiro',
                'description' => 'Diretor Financeiro',
                'department_id' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Diretor Industrial',
                'description' => 'Diretor Industrial',
                'department_id' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
