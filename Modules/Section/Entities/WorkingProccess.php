<?php

namespace Modules\Section\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingProccess extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\WhyChoosUsFactory::new();
    }

    protected $appends = ['home1_title1','home1_title2','home1_title3','home1_title4','home1_description1','home1_description2','home1_description3','home1_description4','home3_title1','home3_title2','home3_title3','home3_title4','home3_description1','home3_description2','home3_description3','home3_description4'];

    protected $hidden = ['front_translate'];

    public function translate(){
        return $this->belongsTo(WorkingProccessTranslation::class, 'id', 'working_proccess_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(WorkingProccessTranslation::class, 'id', 'working_proccess_id')->where('lang_code', front_lang());
    }

    public function getHome1Title1Attribute()
    {
        return $this->front_translate->home1_title1;
    }

    public function getHome1Title2Attribute()
    {
        return $this->front_translate->home1_title2;
    }

    public function getHome1Title3Attribute()
    {
        return $this->front_translate->home1_title3;
    }

    public function getHome1Title4Attribute()
    {
        return $this->front_translate->home1_title4;
    }

    public function getHome1Description1Attribute()
    {
        return $this->front_translate->home1_description1;
    }

    public function getHome1Description2Attribute()
    {
        return $this->front_translate->home1_description2;
    }

    public function getHome1Description3Attribute()
    {
        return $this->front_translate->home1_description3;
    }

    public function getHome1Description4Attribute()
    {
        return $this->front_translate->home1_description4;
    }


    public function getHome3Title1Attribute()
    {
        return $this->front_translate->home3_title1;
    }

    public function getHome3Title2Attribute()
    {
        return $this->front_translate->home3_title2;
    }

    public function getHome3Title3Attribute()
    {
        return $this->front_translate->home3_title3;
    }

    public function getHome3Title4Attribute()
    {
        return $this->front_translate->home3_title4;
    }

    public function getHome3Description1Attribute()
    {
        return $this->front_translate->home3_description1;
    }

    public function getHome3Description2Attribute()
    {
        return $this->front_translate->home3_description2;
    }

    public function getHome3Description3Attribute()
    {
        return $this->front_translate->home3_description3;
    }

    public function getHome3Description4Attribute()
    {
        return $this->front_translate->home3_description4;
    }
}
