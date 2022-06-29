<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'code', 'thumbnail', 'price', 'status'
    ];

    /**
     * The students that belong to the courses.
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id',  'user_id');
    }
}
