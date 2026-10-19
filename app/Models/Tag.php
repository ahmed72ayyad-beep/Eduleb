<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]

class Tag extends Model
{ use HasFactory;
    public function  courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function  blogs()
    {
        return $this->belongsToMany(Blog::class);
    }




}
