<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'link',  'track_id'];

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
