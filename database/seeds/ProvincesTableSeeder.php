<?php

use Illuminate\Database\Seeder;
use App\Province;
class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'name' => 'Benguela',
            'slug' => 'Benguela',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Bengo',
            'slug' => 'Bengo',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Huambo',
            'slug' => 'Huambo',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Huila',
            'slug' => 'huila',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Bié',
            'slug' => 'bie',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Luanda',
            'slug' => 'luanda',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Cunene',
            'slug' => 'cunene',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Cuando Cubango',
            'slug' => 'cuando_cubango',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Moxico',
            'slug' => 'moxico',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Lunda Sul',
            'slug' => 'lunda_sul',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Lunda Norte',
            'slug' => 'lunda_norte',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Cuanza Sul',
            'slug' => 'cuanza_sul',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Cuanza Norte',
            'slug' => 'cuanza_norte',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Cabinda',
            'slug' => 'cabinda',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Zaire',
            'slug' => 'zaire',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Malange',
            'slug' => 'malange',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Uíge',
            'slug' => 'uige',
            'user_id' => 1
        ]);

        Province::create([
            'name' => 'Namibe',
            'slug' => 'namibe',
            'user_id' => 1
        ]);
    }
}
