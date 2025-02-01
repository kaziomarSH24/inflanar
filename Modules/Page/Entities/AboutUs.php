<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\AboutUsFactory::new();
    }

    protected $hidden = ['front_translate'];

    protected $appends = ['header', 'title','description','ceo_name','ceo_designation'];

    public function translate(){
        return $this->belongsTo(AboutUsTranslation::class, 'id', 'about_us_id')->where('lang_code' , admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(AboutUsTranslation::class, 'id', 'about_us_id')->where('lang_code' , front_lang());
    }

    public function getHeaderAttribute()
    {
        return $this->front_translate->header;
    }

    public function getTitleAttribute()
    {
        return $this->front_translate->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->front_translate->description;
    }

    public function getCeoNameAttribute()
    {
        return $this->front_translate->ceo_name;
    }

    public function getCeoDesignationAttribute()
    {
        return $this->front_translate->ceo_designation;
    }

}
