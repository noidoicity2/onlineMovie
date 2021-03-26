<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($data)
 * @method static OnLyName()
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

    public function movieCategories() {
        return $this->hasMany(MovieCategory::class);
    }

    public function scopeOnlyName($query) {
        return $query->select('name');
    }
    public function scopeMoreThan1($query) {
        return $query->select('name');
    }
}
