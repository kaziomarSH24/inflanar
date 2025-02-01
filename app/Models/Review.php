<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\Service;

class Review extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','email','image');
    }

    public function influencer(){
        return $this->belongsTo(User::class,'influencer_id')->select('id','name','email','username');
    }
    
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
