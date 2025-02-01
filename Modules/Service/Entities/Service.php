<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Review;
use Auth;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['title','description','features','seo_title','seo_description','average_rating','total_review'];

    protected $hidden = ['front_translate'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\ServiceFactory::new();
    }

    public function influencer(){
        return $this->belongsTo(User::class)->select('id','name','username','status','is_banned','is_influencer','image');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function translate(){
        return $this->belongsTo(ServiceTranslation::class, 'id', 'service_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(ServiceTranslation::class, 'id', 'service_id')->where('lang_code', front_lang());
    }

    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id');
    }

    public function getTitleAttribute()
    {
        return $this->front_translate->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->front_translate->description;
    }

    public function getFeaturesAttribute()
    {
        return $this->front_translate->features;
    }

    public function getSeoTitleAttribute()
    {
        return $this->front_translate->seo_title;
    }

    public function getSeoDescriptionAttribute()
    {
        return $this->front_translate->seo_description;
    }

    public function is_wishlist($service_id){
        $user = Auth::guard('web')->user();
        $is_exist = Wishlist::where(['user_id' => $user->id, 'service_id' => $service_id])->count();
        if($is_exist == 0) return false;

        return true;

    }

    public function active_reviews(){
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function getAverageRatingAttribute()
    {
        return $this->active_reviews()->avg('rating') ?: '0';
    }

    public function getTotalReviewAttribute()
    {
        return $this->active_reviews()->count();
    }


}
