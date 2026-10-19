<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;
#[Fillable(['title','subject', 'sub_title', 'content',"image","author_id"])]

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;



    public function author()
    {
        return $this->belongsTo(User::class, "author_id")->withDefault();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
//     #[Override]
//     protected function casts()
//     {
//         return [
//             "content"=>"array"
//         ];
//     }
}
