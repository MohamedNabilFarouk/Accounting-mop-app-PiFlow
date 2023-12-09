<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pos;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use JWTAuth;

class PosController extends Controller
{
    use GeneralTrait;
    //store pos
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required',
            'company_id' => 'required',
            'title' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
        Pos::create($request->all()); 
        
        return $this->generalResponse(true,'Pos added successfully',200);
    }

    public function getAllPosOfUser (){
        $user = JWTAuth::user();
        if($user){
            // $data = Pos::where('user_id',$user->id)->get();
            $data = Pos::where('company_id',$user->company_id)->get(); //new
            return $this->generalResponse(true,$data,200);

        }
    }

}
