<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
//    use HasFactory;

    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers ;
    protected   $table          =   "director";
    public      $timestamps     =   false;
    protected $fillable = ['name'	,'description'	];

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
}
