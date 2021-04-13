<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "Transaction";
    public $timestamps = false;
    protected $fillable = ['user_id' , 'membership_id' , 'number_of_day' , 'status' , 'total_amount', 'created_at'];

    public function user () {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function membership () {
        return $this->belongsTo(Membership::class , 'membership_id' , 'id');
    }

}
