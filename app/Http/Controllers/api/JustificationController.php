<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Justification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use JWTAuth;
use Carbon\Carbon;
class JustificationController extends Controller
{
    use GeneralTrait;


        public function store(Request $request){
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                // 'bank_number' => 'required',
                'trans_date'=>"required",
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => 'Missing required fields'], 400);
            }
            Justification::create($request->all()); 
            
            return $this->generalResponse(true,'Justification added successfully',200);
    
        }


    // public function getAllJustOfUser($date){ // get Just of auth user according to date selected before category
        public function getAllJustOfUser(){ // get Just of auth user 
            $user = JWTAuth::user();
            // $date= Carbon::parse($date);
            if($user){
                // $data = Justification::where('user_id',$user->id)->get();
                $data = Justification::where('company_id',$user->company_id)->get(); // new
                // $data = Justification::where('user_id',$user->id)->whereHas('document',function($q)use($date){
                //     $q->where('date',$date);
                // })->get();
                return $this->generalResponse(true,$data,200);
    
            }
        }
}
