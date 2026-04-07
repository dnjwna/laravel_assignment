<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'course_name', 'description', 'price', 'quota',
        'category_id', 'instructor_id',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }
}