<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'description'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}