<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'full_name' => 'Admin LMS',
                'email'     => 'admin@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Instructors
            [
                'full_name' => 'Budi Santoso',
                'email'     => 'budi@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Sari Dewi',
                'email'     => 'sari@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Students
            [
                'full_name' => 'Andi Pratama',
                'email'     => 'andi@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Rizky Ramadhan',
                'email'     => 'rizky@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Putri Ayu',
                'email'     => 'putri@lms.com',
                'password'  => Hash::make('password123'),
                'role'      => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}