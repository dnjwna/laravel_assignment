<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function courseCount()
    {
        $instructors = DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('COUNT(courses.id) as total_courses')
            )
            ->leftJoin('courses', 'users.id', '=', 'courses.instructor_id')
            ->where('users.role', 'instructor')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('total_courses')
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data jumlah kursus per instructor berhasil diambil',
            'data'    => $instructors,
        ]);
    }
}