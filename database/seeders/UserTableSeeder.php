<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'userId' => 'admin_user',
            'email' => 'admin@aeirc.tech',
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
            ['role_id' => 2, 'user_id' => $userId], // Assuming role_id 1 is for the admin role
        ]);
    }
}
