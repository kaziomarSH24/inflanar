<?php

namespace App\Models;

use Modules\Service\Entities\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id')->select('id','name','username','image','designation');
    }

    public function provider(){
        return $this->belongsTo(User::class,'provider_id','id')->select('id','name','username','image','designation');
    }


    public function service(){
        return $this->belongsTo(Service::class,'service_id')->select('id','slug','thumbnail_image');
    }
}
