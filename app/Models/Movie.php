<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 */
class Movie extends Model
{
    use HasFactory;

    protected $table = "movie";
    public      $timestamps     =   false;

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
