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
             'name' => 'Eduardo Patrick',
            'email' => 'teste@teste.com',
            'nickname' => 'edumxk',
            'is_admin' => true,
            'password' => bcrypt('strw4mxk'),
         ]);

        $this->call([
            DepartmentsSeeder::class,
            PositionsSeeder::class,
            ProductCategoriesSeeder::class,
            ProductsSeeder::class,
            ContactsSeeder::class,
        ]);

    }
}
