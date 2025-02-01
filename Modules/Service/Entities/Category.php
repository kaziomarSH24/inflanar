<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = ['name','total_service'];

    protected $hidden = ['front_translate','services'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\CategoryFactory::new();
    }

    public function translate(){
        return $this->belongsTo(CategoryTranslation::class, 'id', 'category_id')->where('lang_code', admin_lang());
    }

    public function front_translate(){
        return $this->belongsTo(CategoryTranslation::class, 'id', 'category_id')->where('lang_code', front_lang());
    }

    public function getNameAttribute()
    {
        return $this->front_translate->name;
    }

    public function services(){
        return $this->hasMany(Service::class)->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable']);
    }

    public function getTotalServiceAttribute()
    {
        return $this->services->count();
    }
}
