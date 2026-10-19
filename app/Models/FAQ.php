<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['question', 'answer', 'author_id'])]

class FAQ extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
