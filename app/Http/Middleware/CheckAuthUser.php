<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_user = Auth::guard('web')->user();
        if($auth_user->is_influencer == 'yes' || $auth_user->is_influencer == 'no'){
            return $next($request);
        }else{
            $notification = 'Please at first login as a client or influencer';
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('home')->with($notification);
        }
        return $next($request);
    }
}
