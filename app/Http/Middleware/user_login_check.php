<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Redirect;


class user_login_check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=user::find(1);
        if(empty(isset($user['attributes']['id']))){
            return redirect('/login');
        }else {
            return $next($request);
        }
    }


//    public function handle($request, Closure $next)
//    {
////        if(empty(Auth::user())) {
////            return redirect('/login');
//////            return Redirect::action('TemplateController@index');
////        }else {
////            return $next($request);
////        }
////
//    return $next($request);
//    }
}
