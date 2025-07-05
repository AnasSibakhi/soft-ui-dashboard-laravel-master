<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['name', 'created_at'];

    // Optional: protected $table = 'tracks';
    // Optional: protected $fillable = ['name', 'description'];

// في Track.php
public function courses() {
    return $this->belongsToMany(Course::class);
}


}
