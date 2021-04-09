<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "membership";
    protected $fillable = ['name' , 'description' , 'price' , 'number_of_day' ,'all_category' ] ;


}
