<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subscription\Database\factories\SubscriptionFeeFactory;

class SubscriptionFee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id', 'type', 'fees'];

    protected static function newFactory(): SubscriptionFeeFactory
    {
        //return SubscriptionFeeFactory::new();
    }
}
