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
        DB::table('users')->insert([
            [
                'name' => 'Super Admin User',
                'userId' => 'super_admin',
                'email' => 'super_admin@aeirc.tech',
                'password' => Hash::make('Nepal@123'),
                'status' => true,
                'email_verified_at' => Carbon::now(),
                'phone_number' => '+977-01-5261884',
                'position' => 'Super Admin',
                'reference' => 'Nepal@123',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@aeirc.tech',
                'password' => Hash::make('Nepal@123'),
                'status' => true,
                'email_verified_at' => Carbon::now(),
                'phone_number' => '+977-01-5261884',
                'position' => 'Admin',
                'reference' => 'Nepal@123'
            ],
        ]);

        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
        ]);
    }
}
