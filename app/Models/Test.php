<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    use Sluggable;


        public      $timestamps     =   false;

    /**
     * @return array
     */
    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
    }
}
