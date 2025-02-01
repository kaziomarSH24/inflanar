<?php

namespace Modules\PaymentGateway\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MultiCurrency;

class MercadoPagoPayment extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\PaymentGateway\Database\factories\MercadoPagoPaymentFactory::new();
    }

    public function currency()
    {
        return $this->belongsTo(MultiCurrency::class, 'currency_id', 'id');
    }
}
