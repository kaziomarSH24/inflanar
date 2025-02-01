<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteRequest extends Model
{
    use HasFactory;

    public function influencer(){
        return $this->belongsTo(User::class,'influencer_id')->select('id','name','email','image','phone','address');
    }

    public function order(){
        return $this->belongsTo(Order::class)->select('id','order_id','total_amount','coupon_discount');
    }
}
