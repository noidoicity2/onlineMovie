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
    protected $appends = ['rating'];
//    protected $rating = null;

    protected $table = "movie";
    public      $timestamps     =   false;
    protected $fillable = [
        'name',	'en_name', 'quality_label'	,'img', 'intro_end'	,'bg_img'	,'description'	,'country_id', 'intro_end' ,
        'duration',	'view_count'	,'category_id'	,'slug'	,'imdb',	'is_movie18', 'director_id',
        'is_finished'	,'is_movie_series'	,'published_at',	'is_on_cinema',	'is_free' , 'source_url','hls_url', 'low_hls_url', 'total_episode',
        'created_at'
    ];
    public function getRatingAttribute()
    {
//        if (! is_null($this->rating)) {
            return $this->hasMany(MovieRating::class)->avg('rating_point');
//        }
//        return $this->rating = $this->hasMany(MovieRating::class)->avg('rating_point');

//        return $this->hasMany(MovieRating::class)->avg('rating_point');

        /// return $this->reviews()->avg('rating'); // this also doesn't work
    }
    public function scopeNewestMovie($query) {
        return $query->select(['id','name' , 'is_free', 'quality_label',  'en_name' ,'is_movie_series' , 'img' , 'bg_img' , 'published_at','total_episode' , 'slug'])->withCount('episodes')->orderByDesc('created_at');
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
    public function movieActors() {
        return $this->hasMany(MovieActor::class, 'movie_id'  , 'id');
    }
    public function movieViews() {
        return $this->hasMany(MovieView::class, 'movie_id'  , 'id');
    }

    public function  country () {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }

    public function director() {
        return $this->belongsTo(Director::class , 'director_id' , 'id');
    }

//    public function getEpisodeCountAttribute()  {
//        return $this->episodes()->count() ;
//    }

}
