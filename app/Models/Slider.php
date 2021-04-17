<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = "slider";
    protected $fillable = ['name' , 'description' , 'image_url', 'display_order' , 'created_at' , 'movie_id'];
    public $timestamps = false;

    public function movie() {
        return $this->belongsTo(Movie::class, 'movie_id' , 'id');
    }
}
