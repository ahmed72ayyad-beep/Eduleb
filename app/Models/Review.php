<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(["user_id", "content", "star_num","course_id"])]

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
