<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CommonTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'user_type', 'email', 'password', 'photo', 'email_verified_at', 'registration_no', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get the user full name.
     *
     * @var array
     */
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * get the user profile photo.
     *
     * @var array
     */
    public function getProfilePhotoAttribute()
    {
        if (Storage::exists($this->photo)) {
            return $this->photo;
        }

        return 'https://ui-avatars.com/api/?name='.$this->name.'&background=random';
    }

    /**
     * The course that belong to the student.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id');
    }


}
