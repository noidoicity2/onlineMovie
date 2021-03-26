<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 */
class Movie extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = "movie";
    public      $timestamps     =   false;
    protected $fillable = [
        'name',	'en_name'	,'img'	,'bg_img'	,'description'	,'country',
        'duration',	'view_count'	,'category_id'	,'slug'	,'imdb',	'is_movie18',
        'is_finished'	,'is_movie_series'	,'published_at',	'is_on_cinema',	'created_at'
    ];

    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source'=>'name'
            ]
        ];
    }

}
