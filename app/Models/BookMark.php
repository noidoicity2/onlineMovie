<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMark extends Model
{
    use HasFactory;


    protected $table = "book_mark";
    protected $fillable = ['user_id' , 'movie_id' , 'episode_id' ,'position' ];

    public      $timestamps     =   false;

    public function  user() {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }

    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' , 'id');
    }

    public function  episode() {
        return $this->belongsTo(Episode::class , 'episode_id' , 'id');
    }
}
