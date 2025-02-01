<?php

namespace Modules\Section\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\WhyChooseUsFactory::new();
    }

    protected $appends = ['home2_title','home2_header','home2_description','home2_item1','home2_item2','home2_item3','home2_des1','home2_des2','home2_des3','home3_title','home3_header','home3_description','home3_item1','home3_item2','home3_item3','home3_des1','home3_des2','home3_des3'];

    protected $hidden = ['front_translate'];


    public function translate(){
        return $this->belongsTo(WhyChooseUsTranslation::class, 'id', 'why_choose_us_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(WhyChooseUsTranslation::class, 'id', 'why_choose_us_id')->where('lang_code', front_lang());
    }

    public function getHome2TitleAttribute()
    {
        return $this->front_translate->home2_title;
    }

    public function getHome2HeaderAttribute()
    {
        return $this->front_translate->home2_header;
    }

    public function getHome2DescriptionAttribute()
    {
        return $this->front_translate->home2_description;
    }

    public function getHome2Item1Attribute()
    {
        return $this->front_translate->home2_item1;
    }

    public function getHome2Item2Attribute()
    {
        return $this->front_translate->home2_item2;
    }

    public function getHome2Item3Attribute()
    {
        return $this->front_translate->home2_item3;
    }

    public function getHome2Des1Attribute()
    {
        return $this->front_translate->home2_des1;
    }

    public function getHome2Des2Attribute()
    {
        return $this->front_translate->home2_des2;
    }

    public function getHome2Des3Attribute()
    {
        return $this->front_translate->home2_des3;
    }

    public function getHome3TitleAttribute()
    {
        return $this->front_translate->home3_title;
    }

    public function getHome3HeaderAttribute()
    {
        return $this->front_translate->home3_header;
    }

    public function getHome3DescriptionAttribute()
    {
        return $this->front_translate->home3_description;
    }

    public function getHome3Item1Attribute()
    {
        return $this->front_translate->home3_item1;
    }

    public function getHome3Item2Attribute()
    {
        return $this->front_translate->home3_item2;
    }

    public function getHome3Item3Attribute()
    {
        return $this->front_translate->home3_item3;
    }

    public function getHome3Des1Attribute()
    {
        return $this->front_translate->home3_des1;
    }

    public function getHome3Des2Attribute()
    {
        return $this->front_translate->home3_des2;
    }

    public function getHome3Des3Attribute()
    {
        return $this->front_translate->home3_des3;
    }

}
