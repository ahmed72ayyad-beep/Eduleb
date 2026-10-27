<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

#[Fillable(['user_id', 'state', 'type', "target_id", "content","reviewed_at"])]

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        "reviewed_at" => "datetime",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    #[Override]
    protected function casts()
    {
        return [
            "content" => "array",
        ];
    }
}
