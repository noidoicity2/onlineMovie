<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    use HasFactory;
    use SluggableScopeHelpers ;
    protected   $table          =   "movie_rating";
    public      $timestamps     =   false;
    protected $fillable = ['movie_id'	,'user_id',	'rating_point' , 'created_at'	];

    public function movie() {
       return  $this->belongsTo(Movie::class , 'movie_id' , 'id');
    }

    public function user() {
        return $this->belongsTo(User::class , 'user_id' , 'id');

    }

}
