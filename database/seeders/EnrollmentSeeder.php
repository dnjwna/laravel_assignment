<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = DB::table('users')->where('role', 'student')->pluck('id');
        $courses  = DB::table('courses')->pluck('id');

        $enrollments = [
            [
                'id_student'  => $students[0],
                'id_course'   => $courses[0],
                'enrolled_at' => now()->subDays(10),
                'created_at'  => now()->subDays(10),
                'updated_at'  => now()->subDays(10),
            ],
            [
                'id_student'  => $students[0],
                'id_course'   => $courses[2],
                'enrolled_at' => now()->subDays(7),
                'created_at'  => now()->subDays(7),
                'updated_at'  => now()->subDays(7),
            ],
            [
                'id_student'  => $students[1],
                'id_course'   => $courses[1],
                'enrolled_at' => now()->subDays(5),
                'created_at'  => now()->subDays(5),
                'updated_at'  => now()->subDays(5),
            ],
            [
                'id_student'  => $students[1],
                'id_course'   => $courses[3],
                'enrolled_at' => now()->subDays(3),
                'created_at'  => now()->subDays(3),
                'updated_at'  => now()->subDays(3),
            ],
            [
                'id_student'  => $students[2],
                'id_course'   => $courses[0],
                'enrolled_at' => now()->subDays(2),
                'created_at'  => now()->subDays(2),
                'updated_at'  => now()->subDays(2),
            ],
            [
                'id_student'  => $students[2],
                'id_course'   => $courses[4],
                'enrolled_at' => now()->subDay(),
                'created_at'  => now()->subDay(),
                'updated_at'  => now()->subDay(),
            ],
        ];

        DB::table('enrollments')->insert($enrollments);
    }
}