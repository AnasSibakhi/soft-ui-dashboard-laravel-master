<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('score')->withTimestamps();
    }

public function answers()
{
    return $this->hasMany(QuizUserAnswer::class, 'quiz_id');
}


public function userAnswer()
{
    return $this->hasOne(QuizUserAnswer::class)->where('user_id', auth()->id());
}

}
