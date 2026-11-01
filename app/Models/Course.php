<?php

namespace App\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'instructor_id', 'title', 'sub_title', 'star_num', 'outer_image', 'inner_image', 'duration', 'date', 'price', 'total_lectures', 'description', 'overview', 'curriculum', 'available_seats', 'status'])]

class Course extends Model
{
    /** @use HasFactory<CourseFactory> */
    use HasFactory;

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->using(CourseUser::class)
            ->withPivot([
                'id',
                'enrollment_id',
                'enrolled_at',
                'notes',
                'state',
            ])
            ->withTimestamps();
    }

    public function LiveLectures()
    {
        return $this->hasMany(Live_lectures::class);
    }

    public function Recordedlectures()
    {
        return $this->hasMany(Recordedlectures::class);
    }
}
