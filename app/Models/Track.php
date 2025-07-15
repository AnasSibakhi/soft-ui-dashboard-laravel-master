<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Track extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at'];


    public function courses()
{
    return $this->hasMany(Course::class); // تأكد من وجود 'track_id'
}

}
