<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [];



    //description json decoded
    // protected $casts = [
    //     'description' => 'array',
    // ];

    public function getDescriptionAttribute($value)
    {
        // dd(json_decode($value, true));
        return json_decode($value, true);
    }

    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionPlanFactory::new();
    }
}
