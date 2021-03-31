<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 */
class Movie extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers ;

    protected $table = "movie";
    public      $timestamps     =   false;
    protected $fillable = [
        'name',	'en_name'	,'img'	,'bg_img'	,'description'	,'country',
        'duration',	'view_count'	,'category_id'	,'slug'	,'imdb',	'is_movie18',
        'is_finished'	,'is_movie_series'	,'published_at',	'is_on_cinema',	'is_free' ,
        'created_at'
    ];
    public function scopeNewestMovie($query) {
        return $query->select(['id','name' , 'is_free', 'en_name' , 'img' , 'bg_img' , 'published_at' , 'slug'])->orderByDesc('created_at');
    }

    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source'=>'name'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categories() {
        return $this->hasMany(MovieCategory::class , 'movie_id' , 'id');
    }

}
