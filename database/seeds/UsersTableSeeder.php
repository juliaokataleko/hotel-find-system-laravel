<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Admnistrador do Sistema',
            'username'  => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456'),
            'email_verified_at' => '2019-11-17 00:00:00', 
            'role' => 1
        ]);
    }
}
