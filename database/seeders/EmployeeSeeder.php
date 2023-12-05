<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        $userId = DB::table('users')->insertGetId([
            'name' => 'Employee User',
            'userId' => 'employee_user',
            'email' => 'employee@aeirc.tech',
            'password' => Hash::make('Nepal@123'),
            'status' => true,
            'email_verified_at' => Carbon::now(),
            'phone_number' => '+977-01-5261884',
            'employee_id' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert roles for the user
        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => $userId], // Assuming role_id 1 is for the admin role
        ]);
    }
}
