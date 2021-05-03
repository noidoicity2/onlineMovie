<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    use HasFactory;

    protected   $table          =   "movie_actor";
    public      $timestamps     =   false;
    protected $fillable = ['movie_id' , 'actor_id'	];

    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' , 'id');
    }
    public function actor() {
        return $this->belongsTo(Actor::class , 'actor_id' , 'id');
    }

}
