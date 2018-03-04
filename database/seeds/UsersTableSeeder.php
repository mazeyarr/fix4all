<?php

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
        \App\User::create([
            "name" => "Mazeyar Rezaei Ghavamabadi",
            "email" => "mazeyarr@gmail.com",
            "password" => bcrypt("mazeyar123")
        ]);
    }
}
