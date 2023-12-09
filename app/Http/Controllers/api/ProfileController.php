<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\filesTrait;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use JWTAuth;

class ProfileController extends Controller
{
    use GeneralTrait,filesTrait;
    //store employee
    public function Update(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
        $user = JWTAuth::user();
       if(!$user){
        return response()->json(['error' => 'there is no Account please try again later'], 400);
       }
        $data = $request->all();
        if($request->has('image')){
            $image = $request->image;
             $data['image'] = $this->saveFiles($image,'clients');
        }
        // dd($data['image']);
        $user->update($data); 
        
        return $this->generalResponse(true,$user,200);
    }

    public function getAllEmployeeOfUser (){
        $user = JWTAuth::user();
        if($user){
            // $data = Employee::where('user_id',$user->id)->get();
            $data = Employee::where('company_id',$user->company_id)->get(); //new
            return $this->generalResponse(true,$data,200);

        }
    }
    public function getAllCompanyUsers (){
        $user = JWTAuth::user();
        if($user){
            // $data = Employee::where('user_id',$user->id)->get();
            $data = User::where('company_id',$user->company_id)->get(); //new
            return $this->generalResponse(true,$data,200);

        }
    }

}
