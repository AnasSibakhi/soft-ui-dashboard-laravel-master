<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
        protected $fillable = ['title', 'link' ,'course_id'];

    use HasFactory;
    public function course() {
    return $this->belongsTo(Course::class);
}

}
