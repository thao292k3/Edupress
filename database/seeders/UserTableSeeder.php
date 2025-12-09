<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234567890'),
                'photo' => null,
                'phone' => '123456789',
                'address' => 'Nghệ An',
                'role' => 'admin',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Instructor User',
                'email' => 'instructor@gmail.com',
                'password' => Hash::make('11111111'),
                'photo' => null,
                'phone' => '987654321',
                'address' => 'Hà Nội',
                'role' => 'instructor',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('00000000'),
                'photo' => null,
                'phone' => '111222333',
                'address' => 'Đà Nẵng',
                'role' => 'user',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);
    }
}
