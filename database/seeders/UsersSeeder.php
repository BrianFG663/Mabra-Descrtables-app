<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['permission_id' => 1, 'name'=>'Adriana', 'email' => 'mabradescartables@gmail.com', 'password' => Hash::make('maiabraian') ]
        ]);
    }
}
