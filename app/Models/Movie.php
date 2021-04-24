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
//    protected $appends = [
//        'episodeCount'
//    ];
    protected $table = "movie";
    public      $timestamps     =   false;
    protected $fillable = [
        'name',	'en_name'	,'img', 'intro_end'	,'bg_img'	,'description'	,'country_id',
        'duration',	'view_count'	,'category_id'	,'slug'	,'imdb',	'is_movie18', 'director_id',
        'is_finished'	,'is_movie_series'	,'published_at',	'is_on_cinema',	'is_free' , 'source_url','hls_url', 'low_hls_url',
        'created_at'
    ];
    public function scopeNewestMovie($query) {
        return $query->select(['id','name' , 'is_free', 'en_name' ,'is_movie_series' , 'img' , 'bg_img' , 'published_at','total_episode' , 'slug'])->withCount('episodes')->orderByDesc('created_at');
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
    public function episodes () {
        return $this->hasMany(Episode::class , 'movie_id' , 'id');
    }
    public function  comments () {
        return $this->hasMany(MovieComment::class , 'movie_id' , 'id');
    }
    public function favoriteMovies() {
        return $this->hasMany(Favorite::class, 'movie_id'  , 'id');
    }
    public function movieRatings() {
        return $this->hasMany(MovieRating::class, 'movie_id'  , 'id');
    }

//    public function getEpisodeCountAttribute()  {
//        return $this->episodes()->count() ;
//    }

}
