<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Шторы', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Тюль', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Римские шторы', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Покрывала', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Декоративные подушки', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
