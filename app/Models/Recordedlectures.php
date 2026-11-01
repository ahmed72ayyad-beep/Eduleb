<?php

namespace App\Models;

use Database\Factories\RecordedlecturesFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['course_id', 'slide', 'video_url', 'duration_minutes', 'title', 'description', "sample_activity"])]

class Recordedlectures extends Model
{
    /** @use HasFactory<RecordedlecturesFactory> */
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
}
