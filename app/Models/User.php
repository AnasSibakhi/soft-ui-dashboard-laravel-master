<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
{
    return $this->role === 'admin';
}
public function orders()
{
    return $this->hasMany(Order::class);
}

public function courses()
{
    return $this->belongsToMany(Course::class)->withPivot('progress')->withTimestamps();
}



public function quizzes()
{
    return $this->belongsToMany(Quiz::class)->withPivot('score', 'completed')->withTimestamps();
}


public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}
}
