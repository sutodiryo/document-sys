<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' =>' noreply.dev.std@gmail.coms',
            // 'email' => Str::random(10).'@example.com',noreply.dev.std@gmail.com
            'password' => '$2y$12$JWMTxeMtBJqjR99XtjDyq.15Dvu3HorpKwqeKuw2U8GouUen2yjrG'
            // 'password' => Hash::make('password'),$2y$12$JWMTxeMtBJqjR99XtjDyq.15Dvu3HorpKwqeKuw2U8GouUen2yjrG
        ]);
    }
}
