<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function track() {
    return $this->belongsTo(Track::class);
}

public function user() {
    return $this->belongsTo(User::class);
}

public function videos() {
    return $this->hasMany(Video::class);
}

public function quizzes() {
    return $this->hasMany(Quiz::class);
}
public function users() {
    return $this->belongsToMany(User::class);
}

public function tracks() {
    return $this->belongsToMany(Track::class);
}


}
