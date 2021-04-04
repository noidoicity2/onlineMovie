<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    use Sluggable;

    use SluggableScopeHelpers ;

    protected $table = "episode";
    public      $timestamps     =   false;
    protected $fillable = ['name' , 'movie_id' , 'source_url' , 'hls_url' , 'low_hls_url' , 'note' ,'season_id' , 'slug'];



    /**
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'=>'name'
            ]
        ];
    }
    public function movie() {
        return $this->belongsTo(Movie::class , 'movie_id' , 'id' );
    }
}
