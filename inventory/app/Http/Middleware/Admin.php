<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Auth;
use Session;
class Admin
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
        if (!Auth::guard('admin')->check()) {
            return redirect('/');
        }else{
            $admiDetails = Auth::guard('admin')->user();
            $admiDetails = json_decode(json_encode($admiDetails),true);
            // echo "<pre>"; print_r($admiDetails); die;
            if($admiDetails['type']=="Super Admin"){
                $admiDetails['nanager_acc'] = 1;
                $admiDetails['moderator_acc'] = 1;
            }
            Session::put('admiDetails',$admiDetails);
            $currentPath= Route::getFacadeRoot()->current()->uri();

            if($currentPath=="admin/admins" && Session::get('admiDetails')['moderator_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            if($currentPath=="admin/suppliers" && Session::get('admiDetails')['moderator_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            if($currentPath=="admin/units" && Session::get('admiDetails')['moderator_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            if($currentPath=="admin/categories" && Session::get('admiDetails')['moderator_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            //manager
            if($currentPath=="admin/paid" && Session::get('admiDetails')['nanager_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            if($currentPath=="admin/wise/report" && Session::get('admiDetails')['nanager_acc']==0){
                return redirect('/admin/dashboard')->with("error_message","access deny!");
            }
            
        }
        return $next($request);
    }
}
