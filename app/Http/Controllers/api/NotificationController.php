<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use JWTAuth;

class NotificationController extends Controller
{
    use GeneralTrait;
    //store pos
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
        Pos::create($request->all()); 
        
        return $this->generalResponse(true,'Pos added successfully',200);
    }


    public function getUserNotifications(){

        // $data= Notification;
      $data= JWTAuth::user()->notifications()->get();
    //   $data[0]['data']['details']
    
        return $this->generalResponse(true,NotificationResource::collection($data),200);

    }

   

}
