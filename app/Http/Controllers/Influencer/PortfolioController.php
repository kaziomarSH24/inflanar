<?php

namespace App\Http\Controllers\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Pagination\Paginator;
use Auth, Image, File;
class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){

        Paginator::useBootstrap();

        $user = Auth::guard('web')->user();

        $portfolios = Portfolio::orderBy('id', 'desc')->where('influencer_id', $user->id)->paginate(15);

        $title = trans('admin.All Portfolio');

        return view('influencer.portfolio_list', compact('portfolios','title'));
    }

    public function create()
    {

        return view('influencer.portfolio_create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
        ],[
            'image.required' => trans('admin_validation.Image is required'),
            'name.required' => trans('admin_validation.Name is required'),
        ]);

        $portfolio = new Portfolio();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'service-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->image->move(public_path('uploads/custom-images/'),$banner_name);
            $portfolio->image = $banner_name;
        }

        $auth_user = Auth::guard('web')->user();

        $portfolio->influencer_id = $auth_user->id;
        $portfolio->status = '1';
        $portfolio->name = $request->name;
        $portfolio->save();

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function edit(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('influencer.portfolio_edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

            $request->validate([
                'name' => 'required',
            ],[
                'name.required' => trans('admin_validation.Name is required'),
            ]);

            if($request->image){
                $exist_banner = $portfolio->image;
                $extention = $request->image->getClientOriginalExtension();
                $banner_name = 'service-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $banner_name = 'uploads/custom-images/'.$banner_name;
                $request->image->move(public_path('uploads/custom-images/'),$banner_name);
                $portfolio->image = $banner_name;
                $portfolio->save();

                if($exist_banner){
                    if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
                }
            }
            $portfolio->name = $request->name;
            $portfolio->status = $request->status;
            $portfolio->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $exist_banner = $portfolio->image;
        if($exist_banner){
            if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
        }

        $portfolio->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
