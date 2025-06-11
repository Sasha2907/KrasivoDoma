<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SewingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sewing_types')->insert([
            [
                'name' => 'На люверсах',
                'image' => 'storage/images/sewing_type/luverses.jfif',
                'overlay_curtain' => 'storage/images/constructor/sewing/naluv1.png',
                'overlay_tulle' => '1',
                'price' => 300.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'На ленте',
                'image' => 'storage/images/sewing_type/naLente.png',
                'overlay_curtain' => 'storage/images/constructor/sewing/lenta.png',
                'overlay_tulle' => '1',
                'price' => 200.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Бантовой складкой',
                'image' => 'storage/images/sewing_type/bant.jpg',
                'overlay_curtain' => 'storage/images/constructor/sewing/bant.png',
                'overlay_tulle' => '1',
                'price' => 250.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
