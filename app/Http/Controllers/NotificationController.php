<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Traits\sendMobNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Resources\NotificationResource;


class NotificationController extends Controller
{
    //
    use sendMobNotification;
   
    public function create(){
        $users = User::all();
        return view('admin.notification.create',compact('users'));
    }


    public function send(Request $request)
    {

        $data = $request -> validate([
            'title' => 'string',
            'body' => 'string',
            'type'=>'required',
            'users'=>'required',

        ]);

        $data = $request->all();

        $users = User::whereIn('id',$request->users)->get();
        foreach($users as $u){     
            $this->sendFCM($request, $u->fcm_token);
            $data['user'] = Auth::user();
            $u->notify(new \App\Notifications\notifications($data));
                session() -> flash('success', trans('Sent Successfully'));
        }
                return redirect()->back();
     }

    public function getAllNotifications(){
        
        $notifications =  DatabaseNotification::orderby('created_at','DESC')->paginate(10);
    
        return view('admin.notification.index',compact('notifications'));
    }
    
   

}
