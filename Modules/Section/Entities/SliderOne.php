<?php

namespace Modules\Section\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderOne extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['home1_title','home1_header','home2_title','home2_header','home3_title','home3_header','home3_item1','home3_item2'];

    protected $hidden = ['front_translate'];

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\SliderOneFactory::new();
    }

    public function translate(){
        return $this->belongsTo(SliderOneTranslation::class, 'id', 'slider_one_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(SliderOneTranslation::class, 'id', 'slider_one_id')->where('lang_code', front_lang());
    }

    public function getHome1TitleAttribute()
    {
        return $this->front_translate->home1_title;
    }

    public function getHome1HeaderAttribute()
    {
        return $this->front_translate->home1_header;
    }

    public function getHome2TitleAttribute()
    {
        return $this->front_translate->home2_title;
    }

    public function getHome2HeaderAttribute()
    {
        return $this->front_translate->home2_header;
    }

    public function getHome3TitleAttribute()
    {
        return $this->front_translate->home3_title;
    }

    public function getHome3HeaderAttribute()
    {
        return $this->front_translate->home3_header;
    }

    public function getHome3Item1Attribute()
    {
        return $this->front_translate->home3_item1;
    }

    public function getHome3Item2Attribute()
    {
        return $this->front_translate->home3_item2;
    }

}
