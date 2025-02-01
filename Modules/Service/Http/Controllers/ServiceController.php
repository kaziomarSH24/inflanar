<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Service\Entities\Service;
use Modules\Service\Entities\ServiceTranslation;
use Modules\Service\Entities\AdditionalService;
use Modules\Service\Entities\AdditionalServiceTranslation;

use Modules\Language\Entities\Language;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\CategoryTranslation;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;

use Session, Image, File;

use Illuminate\Pagination\Paginator;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        Paginator::useBootstrap();

        $services = Service::with('translate','category','influencer')->orderBy('id','desc');

        if($request->influencer){
            $services = $services->where('influencer_id', $request->influencer);
        }

        $services = $services->paginate(15);

        $services = $services->appends($request->all());

        $title = trans('admin_validation.All Service');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        return view('service::service_list', compact('services', 'title','influencers'));
    }

    public function awaiting_for_approval_service(Request $request)
    {
        Paginator::useBootstrap();

        $services = Service::with('translate','category','influencer')->orderBy('id','desc')->where('approve_by_admin','disable');

        $title = trans('admin_validation.Awaiting for approval');

        if($request->influencer){
            $services = $services->where('influencer_id', $request->influencer);
        }

        $services = $services->paginate(15);

        $services = $services->appends($request->all());

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        return view('service::service_list', compact('services', 'title','influencers'));
    }

    public function active_service(Request $request)
    {
        Paginator::useBootstrap();

        $services = Service::with('translate','category','influencer')->orderBy('id','desc')->where(['approve_by_admin' => 'enable', 'is_banned' => 'disable']);

        $title = trans('admin_validation.Active service');

        if($request->influencer){
            $services = $services->where('influencer_id', $request->influencer);
        }

        $services = $services->paginate(15);

        $services = $services->appends($request->all());

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        return view('service::service_list', compact('services', 'title','influencers'));
    }

    public function banned_service(Request $request)
    {
        Paginator::useBootstrap();

        $services = Service::with('translate','category','influencer')->orderBy('id','desc')->where(['is_banned' => 'enable']);

        $title = trans('admin_validation.Banned service');

        if($request->influencer){
            $services = $services->where('influencer_id', $request->influencer);
        }

        $services = $services->paginate(15);

        $services = $services->appends($request->all());

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        return view('service::service_list', compact('services', 'title','influencers'));
    }

    public function create()
    {
        $categories = Category::with('translate')->where('status', 'active')->get();

        $providers = User::where(['status' => 'enable' , 'is_banned' => 'no', 'is_influencer' => 'yes'])->select('id','name','username','status','is_banned','is_influencer')->get();

        return view('service::service_create', compact('categories','providers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'influencer_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:services',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
        ],[
            'image.required' => trans('admin_validation.Image is required'),
            'influencer_id.required' => trans('admin_validation.Influencer is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'price.required' => trans('admin_validation.Price is required'),
            'category_id.required' => trans('admin_validation.Category is required'),
            'description.required' => trans('admin_validation.Description is required')
        ]);

        $service = new Service();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'service-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->image->move(public_path('uploads/custom-images/'),$banner_name);
            $service->thumbnail_image = $banner_name;
        }

        $service->influencer_id = $request->influencer_id;
        $service->category_id = $request->category_id;
        $service->slug = $request->slug;
        $service->price = $request->price;
        $service->status = $request->status;
        $service->tags = $request->tags;
        $service->approve_by_admin = 'enable';
        $service->save();

        $languages = Language::all();
        foreach($languages as $language){
            $service_translation = new ServiceTranslation();
            $service_translation->lang_code = $language->lang_code;
            $service_translation->service_id = $service->id;
            $service_translation->title = $request->name;
            $service_translation->description = $request->description;
            $service_translation->features = json_encode($request->package_features);
            $service_translation->seo_title = $request->seo_title ? $request->seo_title : $request->name;
            $service_translation->seo_description = $request->seo_description ? $request->seo_description : $request->name;
            $service_translation->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service.edit', ['service' => $service->id, 'lang_code' => admin_lang()])->with($notification);

    }

    public function edit(Request $request, $id)
    {
        $categories = Category::with('translate')->where('status', 'active')->get();

        $providers = User::where(['status' => 'enable' , 'is_banned' => 'no', 'is_influencer' => 'yes'])->select('id','name','username','status','is_banned','is_influencer')->get();

        $service = Service::with('translate')->findOrFail($id);

        $translate = ServiceTranslation::where(['service_id' => $id, 'lang_code' => $request->lang_code])->first();

        return view('service::service_edit', compact('categories','providers','service','translate'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::with('translate')->findOrFail($id);

        if($request->lang_code == admin_lang()){
            $request->validate([
                'influencer_id' => 'required',
                'name' => 'required',
                'slug' => 'required|unique:services,slug,'.$id,
                'price' => 'required|numeric',
                'category_id' => 'required',
                'description' => 'required',
            ],[
                'influencer_id.required' => trans('admin_validation.Influencer is required'),
                'name.required' => trans('admin_validation.Name is required'),
                'slug.required' => trans('admin_validation.Slug is required'),
                'slug.unique' => trans('admin_validation.Slug already exist'),
                'price.required' => trans('admin_validation.Price is required'),
                'category_id.required' => trans('admin_validation.Category is required'),
                'description.required' => trans('admin_validation.Description is required')
            ]);

            if($request->image){
                $exist_banner = $service->thumbnail_image;
                $extention = $request->image->getClientOriginalExtension();
                $banner_name = 'service-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $banner_name = 'uploads/custom-images/'.$banner_name;
                $request->image->move(public_path('uploads/custom-images/'),$banner_name);
                $service->thumbnail_image = $banner_name;
                $service->save();

                if($exist_banner){
                    if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
                }
            }

            $service->influencer_id = $request->influencer_id;
            $service->category_id = $request->category_id;
            $service->slug = $request->slug;
            $service->price = $request->price;
            $service->status = $request->status;
            $service->tags = $request->tags;
            if($request->approve_by_admin)$service->approve_by_admin = 'enable';
            if($request->is_banned)$service->is_banned = $request->is_banned;
            $service->save();

            $service_translation = ServiceTranslation::findOrFail($request->translate_id);
            $service_translation->title = $request->name;
            $service_translation->description = $request->description;
            $service_translation->features = json_encode($request->package_features);
            $service_translation->seo_title = $request->seo_title ? $request->seo_title : $request->name;
            $service_translation->seo_description = $request->seo_description ? $request->seo_description : $request->name;
            $service_translation->save();

        }else{
            $request->validate([
                'name' => 'required',
                'description' => 'required',
            ],[
                'name.required' => trans('admin_validation.Name is required'),
                'description.required' => trans('admin_validation.Description is required')
            ]);

            $service_translation = ServiceTranslation::findOrFail($request->translate_id);
            $service_translation->title = $request->name;
            $service_translation->description = $request->description;
            $service_translation->features = json_encode($request->package_features);
            $service_translation->seo_title = $request->seo_title ? $request->seo_title : $request->name;
            $service_translation->seo_description = $request->seo_description ? $request->seo_description : $request->name;
            $service_translation->save();

        }

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $order_exist = Order::where('service_id', $id)->count();
        if($order_exist > 0){
            $notification= trans('admin_validation.You can not delete it, there are mulitple booking available on this service');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        $service = Service::findOrFail($id);
        ServiceTranslation::where(['service_id' => $id])->delete();
        Review::where(['service_id' => $id])->delete();

        $additionals = AdditionalService::with('translate')->where('service_id', $id)->get();

        foreach($additionals as $additional){
            $additional_image = $additional->image;
            if($additional_image){
                if(File::exists(public_path().'/'.$additional_image))unlink(public_path().'/'.$additional_image);
            }

            AdditionalServiceTranslation::where('additional_service_id', $additional->id)->delete();

            $additional->delete();
        }

        $exist_banner = $service->thumbnail_image;
        if($exist_banner){
            if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
        }

        $service->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function assign_language($lang_code){
        $service_translates = ServiceTranslation::where('lang_code', admin_lang())->get();
        foreach($service_translates as $service_translate){
            $translate = new ServiceTranslation();
            $translate->lang_code = $lang_code;
            $translate->service_id = $service_translate->service_id;
            $translate->title = $service_translate->title;
            $translate->description = $service_translate->description;
            $translate->features = $service_translate->features;
            $translate->seo_title = $service_translate->seo_title ;
            $translate->seo_description = $service_translate->seo_description;
            $translate->save();
        }
    }

    public function additional_service(Request $request, $id){

        $additionals = AdditionalService::with('translate')->where('service_id', $id)->get();
        $service = Service::findOrFail($id);

        return view('service::additional_service', compact('additionals','service'));
    }

    public function additional_create($id){

        $service = Service::findOrFail($id);


        return view('service::additional_create', compact('id','service'));
    }

    public function additional_store(Request $request, $id){
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'price' => 'required|numeric'
        ],[
            'image.required' => trans('admin_validation.Image is required'),
            'title.required' => trans('admin_validation.Title is required'),
            'price.required' => trans('admin_validation.Price is required'),
        ]);

        $additional = new AdditionalService();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'add-service'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->image->move(public_path('uploads/custom-images/'),$banner_name);
            $additional->image = $banner_name;
        }

        $additional->service_id = $id;
        $additional->price = $request->price;
        $additional->save();

        $languages = Language::all();
        foreach($languages as $language){
            $additional_translation = new AdditionalServiceTranslation();
            $additional_translation->lang_code = $language->lang_code;
            $additional_translation->additional_service_id = $additional->id;
            $additional_translation->title = $request->title;
            $additional_translation->features = json_encode($request->features);
            $additional_translation->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.additional-edit', ['id' => $additional->id, 'lang_code' => admin_lang()])->with($notification);
    }

    public function additional_edit(Request $request, $id){

        $additional = AdditionalService::findOrFail($id);

        $translate = AdditionalServiceTranslation::where(['additional_service_id' => $id, 'lang_code' => $request->lang_code])->first();

        $service = Service::findOrFail($additional->service_id);

        return view('service::additional_edit', compact('service','additional','translate'));
    }

    public function additional_update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'price' => $request->lang_code == admin_lang() ?  'required|numeric' : ''
        ],[
            'title.required' => trans('admin_validation.Title is required'),
            'price.required' => trans('admin_validation.Price is required'),
        ]);

        $additional = AdditionalService::find($id);

        if($request->image){
            $exist_banner = $additional->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'add-service'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->image->move(public_path('uploads/custom-images/'),$banner_name);
            $additional->image = $banner_name;
            $additional->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->lang_code == admin_lang()){
            $additional->price = $request->price;
            $additional->save();
        }

        $additional_translation = AdditionalServiceTranslation::findOrFail($request->translate_id);
        $additional_translation->title = $request->title;
        $additional_translation->features = json_encode($request->features);
        $additional_translation->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function additional_delete($id){
        $additional = AdditionalService::find($id);
        $exist_banner = $additional->image;
        if($exist_banner){
            if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
        }
        $additional->delete();

        AdditionalServiceTranslation::where('additional_service_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function additional_assign_language($lang_code){
        $additional_translates = AdditionalServiceTranslation::where('lang_code', admin_lang())->get();
        foreach($additional_translates as $additional_translate){
            $translate = new AdditionalServiceTranslation();
            $translate->lang_code = $lang_code;
            $translate->additional_service_id = $additional_translate->additional_service_id;
            $translate->title = $additional_translate->title;
            $translate->features = $additional_translate->features;
            $translate->save();
        }
    }

    public function review_list(Request $request){
        $reviews = Review::with('user','service')->orderBy('id','desc')->get();

        if($request->influencer_id){
            $reviews = $reviews->where('influencer_id', $request->influencer_id);
        }

        return view('service::review_list', compact('reviews'));
    }

    public function show_review($id){
        $review = Review::with('user','service','influencer')->orderBy('id','desc')->where('id', $id)->first();

        return view('service::review_show', compact('review'));
    }

    public function delete_review($id){
        $review = Review::find($id);
        $review->delete();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.review-list')->with($notification);
    }


    public function update_review(Request $request, $id){
        $review = Review::find($id);
        $review->status = $request->status;
        $review->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
