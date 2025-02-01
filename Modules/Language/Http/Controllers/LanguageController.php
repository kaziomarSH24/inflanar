<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Language\Entities\Language;

use Modules\Page\Entities\AboutUsTranslation;
use Modules\Page\Entities\CustomPageTranslation;
use Modules\Page\Entities\TermAndCondition;
use Modules\Page\Entities\PrivacyPolicy;
use Modules\Page\Entities\FaqTranslate;
use Modules\Page\Entities\HomePageTranslation;

use Modules\Page\Http\Controllers\AboutUsController;
use Modules\Page\Http\Controllers\CustomPageController;
use Modules\Page\Http\Controllers\PrivacyPolicyController;
use Modules\Page\Http\Controllers\TermsConditionController;
use Modules\Page\Http\Controllers\FaqController;
use Modules\Page\Http\Controllers\HomePageController;

use Modules\Blog\Entities\BlogCategoryTranslation;
use Modules\Blog\Entities\BlogTranslation;
use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\BlogController;

use Modules\Section\Http\Controllers\OurFeatureController;
use Modules\Section\Http\Controllers\TestimonialController;
use Modules\Section\Http\Controllers\SliderController;
use Modules\Section\Http\Controllers\WorkingProcessController;
use Modules\Section\Http\Controllers\WhyChooseUsController;

use Modules\Section\Entities\OurFeatureTranslation;
use Modules\Section\Entities\TestimonialTranslation;
use Modules\Section\Entities\SliderOneTranslation;
use Modules\Section\Entities\WorkingProccessTranslation;
use Modules\Section\Entities\WhyChooseUsTranslation;

use Modules\Service\Http\Controllers\CategoryController;
use Modules\Service\Http\Controllers\ServiceController;

use Modules\Service\Entities\CategoryTranslation;
use Modules\Service\Entities\ServiceTranslation;
use Modules\Service\Entities\AdditionalServiceTranslation;

use DB, File;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $languages = Language::all();

        return view('language::lang_index', compact('languages'));
    }

    public function create()
    {
        return view('language::lang_create');
    }


    public function store(Request $request)
    {
        $rules = [
            'lang_name'=>'required|unique:languages',
            'lang_code'=>'required|unique:languages'
        ];
        $customMessages = [
            'lang_name.required' => trans('admin_validation.Name is required'),
            'lang_name.unique' => trans('admin_validation.Name already exist'),
            'lang_code.required' => trans('admin_validation.Code is required'),
            'lang_code.unique' => trans('admin_validation.Code already exist'),
        ];
        $request->validate($rules,$customMessages);

        $language = new Language();

        if($request->is_default == 'yes'){
            DB::table('languages')->update(['is_default' => 'No']);
        }

        $language->lang_name = $request->lang_name;
        $language->lang_code = $request->lang_code;
        $language->is_default = $request->is_default;
        $language->lang_direction = $request->lang_direction;
        $language->status = $request->status;
        $language->save();

        /** start blog category*/

        $blog_cat_translate = new BlogCategoryController();
        $blog_cat_translate->assign_language($request->lang_code);

        /** end blog category*/

        /** start blog */

        $blog_translate = new BlogController();
        $blog_translate->assign_language($request->lang_code);

        /** end blog */

        /** start about us */

        $about_us_translate = new AboutUsController();
        $about_us_translate->assign_language($request->lang_code);

        /** end about us */

        /** start custom page */

        $page_translate = new CustomPageController();
        $page_translate->assign_language($request->lang_code);

        /** end custom page */

        /** start t&c page */

        $terms_cond_translate = new TermsConditionController();
        $terms_cond_translate->assign_language($request->lang_code);

        /** end t&c page */

        /** start privacy page */

        $privacy_translate = new PrivacyPolicyController();
        $privacy_translate->assign_language($request->lang_code);

        /** end privacy page */

        /** start faq page */

        $faq_translate = new FaqController();
        $faq_translate->assign_language($request->lang_code);

        /** end faq page */

        /** start feature section */

        $feature_translate = new OurFeatureController();
        $feature_translate->assign_language($request->lang_code);

        /** end feature section */

        /** start testimonial section */

        $testimonial_translate = new TestimonialController();
        $testimonial_translate->assign_language($request->lang_code);

        /** end testimonial section */

        /** start slider section */

        $slider_translate = new SliderController();
        $slider_translate->assign_language($request->lang_code);

        /** end slider section */

        /** start working proccess section */

        $working_translate = new WorkingProcessController();
        $working_translate->assign_language($request->lang_code);

        /** end working proccess section */

        /** start why choose section */

        $why_translate = new WhyChooseUsController();
        $why_translate->assign_language($request->lang_code);

        /** end why choose section */

        /** start home page */

        $home_translate = new HomePageController();
        $home_translate->assign_language($request->lang_code);

        /** end home page */

        /** start service */

        $service_cat_translate = new CategoryController();
        $service_cat_translate->assign_language($request->lang_code);

        $service_translate = new ServiceController();
        $service_translate->assign_language($request->lang_code);

        $additional_translate = new ServiceController();
        $additional_translate->additional_assign_language($request->lang_code);

        /** end service */

        /** generate local language */

        $path = base_path().'/lang'.'/'.$request->lang_code;

        if (! File::exists($path)) {
            File::makeDirectory($path);

            $sourcePath = base_path().'/lang/en';
            $destinationPath = $path;

            // Get all files from the source folder
            $files = File::allFiles($sourcePath);

            foreach ($files as $file) {
                $destinationFile = $destinationPath . '/' . $file->getRelativePathname();

                // Copy the file to the destination folder
                File::copy($file->getRealPath(), $destinationFile);
            }
        }

        /** end generate local language */

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.language.index')->with($notification);
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('language::lang_edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'lang_name'=>'required|unique:languages,id,'.$id,
            'lang_code'=>'required|unique:languages,id,'.$id,
        ];
        $customMessages = [
            'lang_name.required' => trans('admin_validation.Name is required'),
            'lang_name.unique' => trans('admin_validation.Name already exist'),
            'lang_code.required' => trans('admin_validation.Code is required'),
            'lang_code.unique' => trans('admin_validation.Code already exist'),
        ];

        $request->validate($rules,$customMessages);

        $language = Language::findOrFail($id);

        if($request->is_default == 'yes'){
            DB::table('languages')->update(['is_default' => 'no']);
        }

        if($language->is_default == 'yes' && $request->is_default == 'no'){
            DB::table('languages')->where('id', 1)->update(['is_default' => 'yes']);
        }

        $language->lang_name = $request->lang_name;
        $language->is_default = $request->is_default;
        $language->lang_direction = $request->lang_direction;
        $language->status = $request->status;
        $language->save();

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.language.index')->with($notification);
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);

        BlogCategoryTranslation::where('lang_code', $language->lang_code)->delete();
        BlogTranslation::where('lang_code', $language->lang_code)->delete();
        AboutUsTranslation::where('lang_code', $language->lang_code)->delete();
        CustomPageTranslation::where('lang_code', $language->lang_code)->delete();
        TermAndCondition::where('lang_code', $language->lang_code)->delete();
        PrivacyPolicy::where('lang_code', $language->lang_code)->delete();
        FaqTranslate::where('lang_code', $language->lang_code)->delete();
        OurFeatureTranslation::where('lang_code', $language->lang_code)->delete();
        TestimonialTranslation::where('lang_code', $language->lang_code)->delete();
        SliderOneTranslation::where('lang_code', $language->lang_code)->delete();
        WorkingProccessTranslation::where('lang_code', $language->lang_code)->delete();
        WhyChooseUsTranslation::where('lang_code', $language->lang_code)->delete();
        HomePageTranslation::where('lang_code', $language->lang_code)->delete();
        CategoryTranslation::where('lang_code', $language->lang_code)->delete();
        ServiceTranslation::where('lang_code', $language->lang_code)->delete();
        AdditionalServiceTranslation::where('lang_code', $language->lang_code)->delete();

        $path = base_path().'/lang'.'/'.$language->lang_code;

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }

        $language->delete();

        $notification=trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.language.index')->with($notification);

    }

    public function theme_language(Request $request){
        if(File::exists('lang/'.$request->lang_code.'/admin.php')) {
            $data = include('lang/'.$request->lang_code.'/admin.php');

            return view('language::theme_language', ['data' => $data]);
        }else{
            $notification=trans('admin_validation.Your requested language does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.language.index')->with($notification);
        }
    }

    public function update_theme_language(Request $request){

        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }

        file_put_contents('lang/'.$request->lang_code.'/admin.php', "");
        $dataArray = var_export($dataArray, true);
        file_put_contents('lang/'.$request->lang_code.'/admin.php', "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function validation_language(Request $request){

        if(File::exists('lang/'.$request->lang_code.'/admin_validation.php')) {
            $data = include('lang/'.$request->lang_code.'/admin_validation.php');

            return view('language::validation_language', ['data' => $data]);
        }else{
            $notification=trans('admin_validation.Your requested language does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.language.index')->with($notification);
        }
    }

    public function update_validation_language(Request $request){

        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }

        file_put_contents('lang/'.$request->lang_code.'/admin_validation.php', "");
        $dataArray = var_export($dataArray, true);
        file_put_contents('lang/'.$request->lang_code.'/admin_validation.php', "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}
