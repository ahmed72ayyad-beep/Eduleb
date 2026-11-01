<?php

namespace App\Models;

use Database\Factories\LiveLecturesFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['course_id', 'slide', 'live_url', 'starts_at', 'duration_minutes', 'title', 'description', "recorded_url", "sample_activity"])]
class Live_lectures extends Model
{
    /** @use HasFactory<LiveLecturesFactory> */
    use HasFactory;
    protected $casts = [
        "starts_at" => "datetime"
    ];
    public function course()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }
}
