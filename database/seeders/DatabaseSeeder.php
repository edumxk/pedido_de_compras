<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory()->create([
             [
                'name' => 'Eduardo Patrick',
                'email' => 'eduardo.cavalcante@kokar.com.br',
                'nickname' => 'Eduardo TI',
                'is_admin' => true,
                'password' => bcrypt('strw4mxk'),
            ],
            [
                'name' => 'Wanderlei Cichelero',
                'email' => 'wanderlei@kokar.com.br',
                'nickname' => 'Wanderlei',
                'is_admin' => true,
                'password' => bcrypt('kokar@2024'),
            ],
            [
                'name' => 'Edson Alves',
                'email' => 'edson@kokar.com.br',
                'nickname' => 'Edson',
                'is_admin' => true,
                'password' => bcrypt('kokar@2024'),
            ],
            [
                'name' => 'Valéria Cardoso',
                'email' => 'valeria.cardoso@kokar.com.br',
                'nickname' => 'Valéria',
                'is_admin' => false,
                'is_financial' => true,
                'password' => bcrypt('kokar2024'),
            ],
            [
                'name' => 'Maria Aparecida',
                'email' => 'mariaaparecida.ribeiro@kokar.com.br',
                'nickname' => 'Maria Aparecida',
                'is_admin' => false,
                'is_financial' => true,
                'password' => bcrypt('kokar2024')
                ]
         ]);

        $this->call([
            DepartmentsSeeder::class,
            //PositionsSeeder::class,
            ProductCategoriesSeeder::class,
            ProductsSeeder::class,
            ContactsSeeder::class,
        ]);

    }
}
