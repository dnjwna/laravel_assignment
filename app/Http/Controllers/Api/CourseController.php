<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    private const CACHE_TTL = 60;

    public function index(Request $request)
    {
        $cacheKey = 'courses_' . md5(json_encode($request->query()));

        $courses = Cache::remember($cacheKey, self::CACHE_TTL, function () use ($request) {
            $query = Course::with(['category', 'instructor']);

            if ($request->has('search')) {
                $query->where('course_name', 'like', '%' . $request->search . '%');
            }

            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            return $query->get();
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Data kursus berhasil diambil',
            'data'    => $courses,
        ]);
    }

    public function show($id)
    {
        $course = Course::with(['category', 'instructor'])->find($id);

        if (!$course) {
            return response()->json(['status' => 'error', 'message' => 'Kursus tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $course]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name'   => 'required|string|max:200',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric|min:0',
            'quota'         => 'nullable|integer|min:0',
            'category_id'   => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $course = Course::create($request->all());
        Cache::flush();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kursus berhasil ditambahkan',
            'data'    => $course,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['status' => 'error', 'message' => 'Kursus tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'course_name'   => 'sometimes|string|max:200',
            'description'   => 'nullable|string',
            'price'         => 'sometimes|numeric|min:0',
            'quota'         => 'nullable|integer|min:0',
            'category_id'   => 'sometimes|exists:categories,id',
            'instructor_id' => 'sometimes|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $course->update($request->all());
        Cache::flush();

        return response()->json(['status' => 'success', 'message' => 'Kursus berhasil diperbarui', 'data' => $course]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['status' => 'error', 'message' => 'Kursus tidak ditemukan'], 404);
        }

        $course->delete();
        Cache::flush();

        return response()->json(['status' => 'success', 'message' => 'Kursus berhasil dihapus']);
    }
}