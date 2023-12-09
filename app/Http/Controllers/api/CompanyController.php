<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use App\Traits\filesTrait;
use JWTAuth;
use App\Models\User;
use App\Models\Company;

class CompanyController extends Controller
{
    use GeneralTrait,filesTrait;
    public function getAllCompanyUsers (){
        $user = JWTAuth::user();
        if($user->role == 2){ // company admin
            // $data = Employee::where('user_id',$user->id)->get();
            $data = User::where([['company_id',$user->company_id],['role','3']])->get(); //new
            return $this->generalResponse(true,$data,200);
        }else{
            return $this->generalResponse(false,'There is no Access',400);
        }
    }

    public function DeleteCompanyUser(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
    

        $user = JWTAuth::user();
        if(($user->role == 2)){ // company admin
          
            User::where([['id',$request->user_id],['role','3']])->delete();
            return $this->generalResponse(true,'Deleted Successfully',200);
        }else{
            return $this->generalResponse(false,'There is no Access',400);
        }

    }

    public function userActivation(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
        $client = JWTAuth::user();
        // dd($client);
        if($client->role == 2){ // company admin
        $user = User::findOrFail($request->user_id);
        if($user->status['text'] == 'Inactive'){
            $user->update([
                'status'=>1,
            ]);
            return $this->generalResponse(true,$user->status['text'],200);
        }else{
            $user->update([
                'status'=>0
            ]);
            return $this->generalResponse(true,$user->status['text'],200);
        }
    }else{
        return $this->generalResponse(false,'There is no Access',400);
    }
        
     }

     public function updateCompanyInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'tax_register' => 'string|max:255',
            'com_register' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $client = JWTAuth::user();
        if($client->role == 2){ // company admin
            $company = Company::where('id',$client->company_id)->first();
            $data = $request->all();
            if($request->has('image')){
                $image = $request->image;
                 $data['image'] = $this->saveFiles($image,'company');
            }
            // dd($data['image']);
            $company->update($data); 
            
            return $this->generalResponse(true,$company,200);
          
        }else{
            return $this->generalResponse(false,'There is no Access',400);
        }
     }
}
