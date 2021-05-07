<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "membership";
    protected $fillable = ['name' , 'description' , 'price' , 'number_of_day' , 'created_at' ] ;

    public function membershipCategories() {
       return $this->hasMany(MembershipCategory::class , 'membership_id' , 'id');
    }
    public function categories() {
        return $this->belongsToMany(Category::class , MembershipCategory::class);
    }



}
