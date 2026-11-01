<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    protected $table = 'course_user';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'enrolled_at' => 'datetime',
        ];
    }
}
