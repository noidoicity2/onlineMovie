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

   public function membership()  {
       return $this->belongsTo(Membership::class, 'membership_id' , 'id');
   }

   public function  user() {
       return $this->belongsTo(User::class, 'user_id' , 'id');
   }
}
