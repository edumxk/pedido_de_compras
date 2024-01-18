<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\DepartmentFactory;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed departments factory
        DB::table('departments')->insert(
            [
                [
                    'name' => 'Diretoria',
                    'description' => 'Diretoria da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Financeiro',
                    'description' => 'Setor financeiro da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'RH',
                    'description' => 'Setor de Recursos Humanos da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'TI',
                    'description' => 'Setor de Tecnologia da Informação da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Comercial',
                    'description' => 'Setor Comercial da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Marketing',
                    'description' => 'Setor de Marketing da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Produção',
                    'description' => 'Setor de Produção da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Logística',
                    'description' => 'Setor de Logística da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Manutenção',
                    'description' => 'Setor de Manutenção da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'WMS',
                    'description' => 'Setor de WMS da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Limpeza',
                    'description' => 'Setor de Limpeza da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Almoxarifado',
                    'description' => 'Setor de Almoxarifado da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Compras',
                    'description' => 'Setor de Compras da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Jurídico',
                    'description' => 'Setor Jurídico da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Contabilidade',
                    'description' => 'Setor de Contabilidade da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Fiscal',
                    'description' => 'Setor Fiscal da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Contas a Pagar',
                    'description' => 'Setor de Contas a Pagar da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Contas a Receber',
                    'description' => 'Setor de Contas a Receber da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Faturamento',
                    'description' => 'Setor de Faturamento da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'PCP',
                    'description' => 'Setor de Planejamento e Controle de Produção da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Qualidade',
                    'description' => 'Setor de Controle de Qualidade da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Projetos',
                    'description' => 'Setor de Projetos da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Suprimentos',
                    'description' => 'Setor de Suprimentos da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'P&D',
                    'description' => 'Setor de Pesquisa e Desenvolvimento da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Comunicação',
                    'description' => 'Setor de Comunicação da empresa',
                    'created_at' => now(),
                ],
                [
                    'name' => 'Administração',
                    'description' => 'Setor de Administração da empresa',
                    'created_at' => now(),
                ]
            ]
        );


    }
}
