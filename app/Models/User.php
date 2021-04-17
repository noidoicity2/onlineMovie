<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'active' ,
        'is_locked' ,
        'role_id' ,
        'is_vip' ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    public function comments() {
        return $this->hasMany(MovieComment::class, 'user_id' , 'is');
    }
    public function scopeLockedUser($query) {
        return $query->where('is_locked' ,1);
    }
}
