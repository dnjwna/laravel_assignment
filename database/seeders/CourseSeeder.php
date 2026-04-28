<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID instructor & category dari DB
        $instructors = DB::table('users')->where('role', 'instructor')->pluck('id');
        $categories  = DB::table('product_categories')->pluck('id');

        $courses = [
            [
                'course_name'   => 'Laravel untuk Pemula',
                'description'   => 'Belajar Laravel dari nol hingga membuat REST API lengkap.',
                'price'         => 299000,
                'quota'         => 30,
                'id_category'   => $categories[0], // Web Development
                'id_instructor' => $instructors[0],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'course_name'   => 'React JS Mastery',
                'description'   => 'Kuasai React JS dari dasar hingga hooks dan state management.',
                'price'         => 349000,
                'quota'         => 25,
                'id_category'   => $categories[0], // Web Development
                'id_instructor' => $instructors[1],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'course_name'   => 'Flutter Development',
                'description'   => 'Bangun aplikasi mobile cross-platform dengan Flutter & Dart.',
                'price'         => 399000,
                'quota'         => 20,
                'id_category'   => $categories[1], // Mobile Development
                'id_instructor' => $instructors[0],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'course_name'   => 'Python untuk Data Science',
                'description'   => 'Analisis data menggunakan Python, Pandas, dan Matplotlib.',
                'price'         => 449000,
                'quota'         => 15,
                'id_category'   => $categories[2], // Data Science
                'id_instructor' => $instructors[1],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'course_name'   => 'Figma UI/UX Design',
                'description'   => 'Desain antarmuka aplikasi modern menggunakan Figma.',
                'price'         => 199000,
                'quota'         => 40,
                'id_category'   => $categories[3], // UI/UX Design
                'id_instructor' => $instructors[0],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'course_name'   => 'Ethical Hacking Dasar',
                'description'   => 'Pelajari dasar-dasar cybersecurity dan ethical hacking.',
                'price'         => 499000,
                'quota'         => 20,
                'id_category'   => $categories[4], // Cybersecurity
                'id_instructor' => $instructors[1],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}