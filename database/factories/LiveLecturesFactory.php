<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveLectures extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
}
