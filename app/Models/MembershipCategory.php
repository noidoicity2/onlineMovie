<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipCategory extends Model
{
    use HasFactory;
    protected $table = 'membership_category';
    protected $fillable = ['category_id' , 'membership_id'];
    public      $timestamps     =   false;
}