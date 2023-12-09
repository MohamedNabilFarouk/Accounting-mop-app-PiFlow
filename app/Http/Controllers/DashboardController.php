<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\OrderRecommendation;
use App\Recommendation;
use App\Models\User;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
   

    public function index(Request $request){
        $companies = Company::query()->where(function ($query) use ($request) {
            if($request->name!= null){
                $query->where('name', 'like', '%' . $request->name . '%');
                }
            
            if($request->status!=null){
                $query->where('status',$request->status);
            }
            if($request->expire != null){
                $query->whereDate('subscription_to', '<=', Carbon::today()->addDays(7));
            }
         })->orderBy('id','desc')->paginate(20);
         return view('admin.dashboard',compact('companies'));
    }
    
    public function loginadmin(Request $request)
    {
        $password= $request->input('password');
        if (Auth::attempt(['email' => $request->input('identify') , 'password'=> $password])) {
            return redirect(url('admin/dashboard'))->with('message','تم الدخول بنجاح');
        }
        return redirect()->route('login')->with(['error' => 'هناك خطا بالبيانات']);
    }

}
