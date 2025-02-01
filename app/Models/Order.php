<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\Service;

class Order extends Model
{
    use HasFactory;

    public function influencer(){
        return $this->belongsTo(User::class,'influencer_id')->select('id','name','email','image','phone','address','designation','is_influencer','username');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function client(){
        return $this->belongsTo(User::class,'client_id')->select('id','name','email','image','phone','address');
    }

}
