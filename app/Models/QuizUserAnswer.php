<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'is_correct',
        'answers',
        'score'
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // العلاقة مع الكويز
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
