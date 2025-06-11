<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SewingTypeSeeder::class,
            CategorySeeder::class, // если нужно
        ]);


        // \App\Models\User::factory(10)->create();
    }
}
