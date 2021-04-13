<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    use HasFactory;
   protected $table = "user_membership";
   protected $fillable = ['user_id' , 'membership_id' , 'created_at' , 'expired_date'];
   public      $timestamps     =   false;
}
