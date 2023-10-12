<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'superadmin', 'display_name' => "Super Admin"],
            ['name' => 'admin', 'display_name' => "Admin"],
            ['name' => 'manageradmin', 'display_name' => "Manager Admin"],
            ['name' => 'employee', 'display_name' => "Employee"],
        ]);
    }
}
