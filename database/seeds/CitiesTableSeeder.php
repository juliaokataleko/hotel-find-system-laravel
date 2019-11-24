<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'Cubal',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Benguela',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Lobito',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Catumbela',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Ganda',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Baia Farta',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Caimbambo',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Balombo',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Bocoio',
            'province_id' => 1,
            'user_id' => 1
        ]);

        City::create([
            'name' => 'Chongoroi',
            'province_id' => 1,
            'user_id' => 1
        ]);

    }
}
