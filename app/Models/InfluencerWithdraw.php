<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerWithdraw extends Model
{
    use HasFactory;


    public function influencer(){
        return $this->belongsTo(User::class,'influencer_id')->select('id','name','email','username');
    }
}
