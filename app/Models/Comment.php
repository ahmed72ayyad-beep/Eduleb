<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['content', "user_id", "blog_id"])]

class Comment extends Model
{


    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;





    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
