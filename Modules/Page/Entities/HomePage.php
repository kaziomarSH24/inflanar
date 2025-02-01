<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePage extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $hidden = ['front_translate'];

    protected static function newFactory()
    {
        return \Modules\Section\Database\factories\HomePageFactory::new();
    }

    protected $appends = ['feature_title','feature_header','influencer_title','influencer_header','service_title','service_header','working_title','working_header','video_title','video_description','partner_title','partner_description','faq_title','faq_header','faq_description','feature_title','feature_header','provider_joining_title','testimonial_title','testimonial_header','category_title','category_header'];

    public function translate(){
        return $this->belongsTo(HomePageTranslation::class, 'id', 'home_page_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(HomePageTranslation::class, 'id', 'home_page_id')->where('lang_code', front_lang());
    }

    public function getFeatureTitleAttribute()
    {
        return $this->front_translate->feature_title;
    }

    public function getFeatureHeaderAttribute()
    {
        return $this->front_translate->feature_header;
    }

    public function getInfluencerTitleAttribute()
    {
        return $this->front_translate->influencer_title;
    }

    public function getInfluencerHeaderAttribute()
    {
        return $this->front_translate->influencer_header;
    }

    public function getServiceTitleAttribute()
    {
        return $this->front_translate->service_title;
    }

    public function getServiceHeaderAttribute()
    {
        return $this->front_translate->service_header;
    }

    public function getWorkingTitleAttribute()
    {
        return $this->front_translate->working_title;
    }

    public function getWorkingHeaderAttribute()
    {
        return $this->front_translate->working_header;
    }

    public function getVideoTitleAttribute()
    {
        return $this->front_translate->video_title;
    }

    public function getVideoDescriptionAttribute()
    {
        return $this->front_translate->video_description;
    }

    public function getPartnerTitleAttribute()
    {
        return $this->front_translate->partner_title;
    }

    public function getPartnerDescriptionAttribute()
    {
        return $this->front_translate->partner_description;
    }

    public function getFaqTitleAttribute()
    {
        return $this->front_translate->faq_title;
    }

    public function getFaqHeaderAttribute()
    {
        return $this->front_translate->faq_header;
    }

    public function getFaqDescriptionAttribute()
    {
        return $this->front_translate->faq_description;
    }

    public function getBlogTitleAttribute()
    {
        return $this->front_translate->blog_title;
    }

    public function getBlogHeaderAttribute()
    {
        return $this->front_translate->blog_header;
    }

    public function getProviderJoiningTitleAttribute()
    {
        return $this->front_translate->provider_joining_title;
    }

    public function getTestimonialTitleAttribute()
    {
        return $this->front_translate->testimonial_title;
    }

    public function getTestimonialHeaderAttribute()
    {
        return $this->front_translate->testimonial_header;
    }

    public function getCategoryTitleAttribute()
    {
        return $this->front_translate->category_title;
    }

    public function getCategoryHeaderAttribute()
    {
        return $this->front_translate->category_header;
    }

}
