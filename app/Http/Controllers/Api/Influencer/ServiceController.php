<?php

namespace App\Http\Controllers\Api\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

use Illuminate\Pagination\Paginator;
use Auth, Image, File;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        Paginator::useBootstrap();

        $user = Auth::guard('api')->user();

        $services = Service::with('category')->orderBy('id', 'desc')->where('influencer_id', $user->id)->paginate(15);

        $title = trans('admin_validation.All Service');

        return response()->json([
            'services' => $services,
            'title' => $title,
        ]);

    }

    public function awaiting_for_approval(){

        Paginator::useBootstrap();

        $user = Auth::guard('api')->user();

        $services = Service::with('category')->orderBy('id', 'desc')->where('approve_by_admin','disable')->where('influencer_id', $user->id)->paginate(15);

        $title = trans('admin_validation.Awaiting for Approval');

        return response()->json([
            'services' => $services,
            'title' => $title,
        ]);

    }

    public function active_service(){

        Paginator::useBootstrap();

        $user = Auth::guard('api')->user();

        $services = Service::with('category')->orderBy('id', 'desc')->where(['approve_by_admin' => 'enable', 'is_banned' => 'disable'])->where('influencer_id', $user->id)->paginate(15);

        $title = trans('admin_validation.Active Service');

        return response()->json([
            'services' => $services,
            'title' => $title,
        ]);

    }

     public function banned_service(){

        Paginator::useBootstrap();

        $user = Auth::guard('api')->user();

        $services = Service::with('category')->orderBy('id', 'desc')->where(['is_banned' => 'enable'])->where('influencer_id', $user->id)->paginate(15);

        $title = trans('admin_validation.Banned Service');

        return response()->json([
            'services' => $services,
            'title' => $title,
        ]);

    }

    public function create()
    {
        $categories = Category::with('translate')->where('status', 'active')->get();

        return response()->json([
            'categories' => $categories,
        ]);

        return view('influencer.service_create', compact('categories'));
    }

    public function store(Request $request)
    {
        
        
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:services',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
            'package_features' => 'required',
        ],[
            'image.required' => trans('admin_validation.Image is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'price.required' => trans('admin_validation.Price is required'),
            'category_id.required' => trans('admin_validation.Category is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'package_features.required' => trans('admin_validation.Package Features is required'),
        ]);

        $service = new Service();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'service-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->image->move(public_path('uploads/custom-images/'),$banner_name);
            $service->thumbnail_image = $banner_name;
        }

        $auth_user = Auth::guard('api')->user();

        $service->influencer_id = $auth_user->id;
        $service->category_id = $request->category_id;
        $service->slug = $request->slug;
        $service->price = $request->price;
        $service->status = 'active';
        $service->tags = $request->tags;
        $service->approve_by_admin = 'disable';
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
        return response()->json([
            'message' => $notification
        ]);

    }

    public function show(Request $request, $id)
    {
        $categories = Category::with('translate')->where('status', 'active')->get();

        $service = Service::findOrFail($id);

        $translate = ServiceTranslation::where(['service_id' => $id, 'lang_code' => $request->lang_code])->first();

        return response()->json([
            'categories' => $categories,
            'service' => $service,
            'translate' => $translate,
        ]);

    }

    public function update(Request $request, $id)
    {
        $service = Service::with('translate')->find($id);

        if($request->lang_code == front_lang()){
            $request->validate([
                'name' => 'required',
                // 'slug' => 'required|unique:services,slug,'.$id,
                'price' => 'required|numeric',
                'category_id' => 'required',
                'description' => 'required',
            ],[
                'name.required' => trans('admin_validation.Name is required'),
                // 'slug.required' => trans('admin_validation.Slug is required'),
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
            
           
            
            $service->category_id = $request->category_id;
            $service->slug = $request->slug;
            $service->price = $request->price;
            $service->status = $request->status;
            $service->tags = $request->tags;
            $service->save();
            

            $service_translation = ServiceTranslation::find($request->translate_id);
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
        return response()->json([
            'message' => $notification
        ]);
    }

    public function destroy($id)
    {
        $order_exist = Order::where('service_id', $id)->count();
        if($order_exist > 0){
            $notification= trans('admin_validation.You can not delete it, there are mulitple booking available on this service');
            return response()->json([
                'message' => $notification
            ]);
        }

        $service = Service::findOrFail($id);
        ServiceTranslation::where(['service_id' => $id])->delete();
        Review::where(['service_id' => $id])->delete();

        $exist_banner = $service->thumbnail_image;
        if($exist_banner){
            if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
        }

        $additionals = AdditionalService::with('translate')->where('service_id', $id)->get();

        foreach($additionals as $additional){
            $additional_image = $additional->image;
            if($additional_image){
                if(File::exists(public_path().'/'.$additional_image))unlink(public_path().'/'.$additional_image);
            }

            AdditionalServiceTranslation::where('additional_service_id', $additional->id)->delete();

            $additional->delete();
        }

        $service->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function additional_service(Request $request, $id){

        $additionals = AdditionalService::with('translate')->where('service_id', $id)->get();
        $service = Service::findOrFail($id);

        return response()->json([
            'additionals' => $additionals,
            'service' => $service
        ]);

    }

    public function additional_create($id){

        $service = Service::findOrFail($id);

        return response()->json([
            'id' => $id,
            'service' => $service
        ]);

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
        return response()->json([
            'message' => $notification
        ]);
    }

    public function additional_edit(Request $request, $id){


        $additional = AdditionalService::findOrFail($id);
        $translate = AdditionalServiceTranslation::where(['additional_service_id' => $id, 'lang_code' => $request->lang_code])->first();

        $service = Service::findOrFail($additional->service_id);

        return response()->json([
            'service' => $service,
            'additional' => $additional,
            'translate' => $translate,
        ]);

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
        return response()->json([
            'message' => $notification
        ]);
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
        return response()->json([
            'message' => $notification
        ]);
    }

    public function review_list(){

        $user = Auth::guard('api')->user();

        $reviews = Review::with('user','service')->orderBy('id','desc')->where('influencer_id', $user->id)->get();

        return response()->json([
            'reviews' => $reviews
        ]);

    }

    public function review_show($id){
        $review = Review::with('user','service')->orderBy('id','desc')->where('id', $id)->first();

        return response()->json([
            'review' => $review
        ]);

    }
}

