<?php

namespace App\Models;

use Illuminate\Support\Str; // ← لازم هذا السطر
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'link',  'track_id' ,'description' ,'slug'];

  protected static function booted()
    {
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }
public function users()
{
    return $this->belongsToMany(User::class);
}

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }
public function photos()
{
    return $this->morphMany(Photo::class, 'photoable');
}
public function track()
{
    return $this->belongsTo(Track::class);
}


}
