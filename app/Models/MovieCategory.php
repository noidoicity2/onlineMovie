<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCategory extends Model
{
    use HasFactory;
    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' ,'id');
    }
}
