<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function detail()
    {
        $enrollments = DB::table('enrollments')
            ->select(
                'enrollments.id as id_enrollment',
                'enrollments.status',
                'enrollments.created_at as enrolled_at',
                'users.id as user_id',
                'users.name as student_name',
                'users.email as student_email',
                'courses.id as course_id',
                'courses.course_name',
                'courses.price',
                'categories.name as category_name'
            )
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('categories', 'courses.category_id', '=', 'categories.id')
            ->orderBy('enrollments.created_at', 'desc')
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data detail enrollment berhasil diambil',
            'total'   => $enrollments->count(),
            'data'    => $enrollments,
        ]);
    }
}