<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static CountryForSelect()
 */
class Country extends Model
{


    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers ;
    protected   $table          =   "country";
    public      $timestamps     =   false;
    protected $fillable = ['name'	,'description',	'country_order'	];

    /**
     * @return array
     */
    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source'=>'name'
            ]
        ];
    }
    public function scopeCountryForSelect($query ) {
        return $query->select('name' , 'id');
    }
    public function movies() {
        return $this->hasMany(Movie::class, 'country_id' , 'id');
    }

}
