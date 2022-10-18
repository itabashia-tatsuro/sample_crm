<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追記
use Illuminate\Support\Facades\Hash; // 追記
use Illuminate\Support\Str; // 追記

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
            // 'name' => Str::random(10),
            // 'email' => Str::random(10).'@gmail.com',
            // 'password' => Hash::make('password'),
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
