<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    }
}
