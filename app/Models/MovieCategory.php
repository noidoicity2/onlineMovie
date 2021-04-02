<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCategory extends Model
{
    use HasFactory;



    protected $table = "movie_category";
    public      $timestamps     =   false;
    protected $fillable= ['category_id' , 'movie_id'];
    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' ,'id');
    }
    public function category() {
        return $this->belongsTo(Movie::class , 'category_id' ,'id');
    }


}
