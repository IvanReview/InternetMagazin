<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Админитратор',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('12345678'),
            'is_admin' => 1,
        ]);
    }
}
