<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMovie extends Model
{

    protected   $table          =   "request_movie";
    public      $timestamps     =   false;

    protected $fillable = ['user_id' , 'movie_name' , 'director_name'];

    public function user() {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
