<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 */
class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected   $table          =   "category";
    public      $timestamps     =   false;

    protected $fillable = ['name' , 'slug' , 'description'];


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
