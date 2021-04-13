<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchingMovie extends Model
{
    protected $table = 'watching_movie';
    public $timestamps = false;
    protected $fillable = ['movie_id', 'episode_id', 'book_mark_at', 'created_at'];

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id', 'id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }

}
