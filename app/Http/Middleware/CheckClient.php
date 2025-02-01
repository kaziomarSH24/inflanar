<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_user = Auth::guard('web')->user();
        if($auth_user->is_influencer == 'no'){
            return $next($request);
        }else{
            if($request->ajax()){
                $notification= trans('admin_validation.Please at first login as a client');
                return response()->json(['message' => $notification],403);
            }else{
                $notification= trans('admin_validation.Please at first login as a client');
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('home')->with($notification);
            }

        }

        return $next($request);
    }
}
