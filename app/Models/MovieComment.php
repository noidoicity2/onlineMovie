<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieComment extends Model
{
    use HasFactory;

    protected $table = "movie_comment";
    public      $timestamps     =   false;
    protected $fillable= ['user_id' , 'movie_id' , 'content' , 'created_at'];
}
