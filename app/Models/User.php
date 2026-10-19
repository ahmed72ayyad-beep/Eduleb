<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email',"image", 'password', "last_login"])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // public function __construct()
    // {
    //     $this->assignRole("student");
    // }
    protected $casts = [
        'last_login' => 'datetime',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function reviews()
    {

        return $this->hasMany(Review::class);
    }
    public function blogs()
    {

        return $this->hasMany(Blog::class);
    }
    public function courses()
    {

        return $this->belongsToMany(Course::class);
    }
    // public function instructors()
    // {

    //     return $this->belongsToMany(Instructor::class);
    // }
    public function FAQS()
    {

        return $this->hasMany(FAQ::class, "author_id");
    }

    public function instructor_Profile()
    {
        return $this->belongsTo(Instructor::class)->withDefault();
    }
}
