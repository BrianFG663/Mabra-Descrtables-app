<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionsSeeder::class, //crear los dos tipos de permisos
        ]); 

        $this->call([
            UsersSeeder::class, //crea el usuario principal 
        ]);
    }
}
