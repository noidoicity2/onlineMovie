<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';
    public      $timestamps     =   false;
    protected $fillable = ['user_id' , 'movie_id',  'created_at'];

    public function user() {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' , 'id');
    }


    public function movieCategories() {
        return $this->hasManyThrough(MovieCategory::class , Movie::class , 'id' , 'movie_id' ,'movie_id' );
    }

    public function episodes() {
        return $this->hasManyThrough(Episode::class , Movie::class , 'id' , 'movie_id' ,'movie_id' );
    }

}
