<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['name' , 'description' , 'img'];


        public      $timestamps     =   false;

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
