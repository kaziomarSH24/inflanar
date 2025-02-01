<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdditionalService extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['title', 'features'];

    protected $hidden = ['front_translate'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\AdditionalServiceFactory::new();
    }

    public function translate(){
        return $this->belongsTo(AdditionalServiceTranslation::class, 'id', 'additional_service_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(AdditionalServiceTranslation::class, 'id', 'additional_service_id')->where('lang_code', front_lang());
    }

    public function getTitleAttribute()
    {
        return $this->front_translate->title;
    }

    public function getFeaturesAttribute()
    {
        return $this->front_translate->features;
    }


}
