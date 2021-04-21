<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieView extends Model
{
    use HasFactory;


        protected $table = "movie_view";
        protected $fillable = ['movie_id' , 'episode_id' , 'created_at' , 'user_id'];
        public      $timestamps     =   false;

        public function movie () {
            return $this->belongsTo(Movie::class, 'movie_id' ,'id');
        }
        public function episode () {
            return $this->belongsTo(Episode::class, 'episode_id' ,'id');
        }

        public function user() {
            return $this->belongsTo(User::class , 'user_id' , 'id');
        }
}
