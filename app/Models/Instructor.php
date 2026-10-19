<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'major',
    'personal_image',
    'email',
    'description',
    'phone',
    'portfolio_link',
    "user_id","job_title",
])]

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function user()
    {
        return $this->hasone(User::class);
    }
}
