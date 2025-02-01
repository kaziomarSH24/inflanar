<?php

namespace Modules\Section\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurFeature extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['title1','title2','title3','title4','description1','description2','description3','description4'];

    protected $hidden = ['front_translate'];

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\OurFeatureFactory::new();
    }

    public function translate(){
        return $this->belongsTo(OurFeatureTranslation::class, 'id', 'our_feature_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(OurFeatureTranslation::class, 'id', 'our_feature_id')->where('lang_code', front_lang());
    }

    public function getTitle1Attribute()
    {
        return $this->front_translate->title1;
    }

    public function getTitle2Attribute()
    {
        return $this->front_translate->title2;
    }

    public function getTitle3Attribute()
    {
        return $this->front_translate->title3;
    }

    public function getTitle4Attribute()
    {
        return $this->front_translate->title4;
    }

    public function getDescription1Attribute()
    {
        return $this->front_translate->description1;
    }

    public function getDescription2Attribute()
    {
        return $this->front_translate->description2;
    }

    public function getDescription3Attribute()
    {
        return $this->front_translate->description3;
    }

    public function getDescription4Attribute()
    {
        return $this->front_translate->description4;
    }

}
