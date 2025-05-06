<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['permission' => 'administrador','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['permission' => 'empleado','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
