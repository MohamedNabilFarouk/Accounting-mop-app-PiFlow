<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use JWTAuth;

class EmployeeController extends Controller
{
    use GeneralTrait;
    //store employee
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'balance' => 'numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
        Employee::create($request->all()); 
        
        return $this->generalResponse(true,'employee added successfully',200);
    }

    public function getAllEmployeeOfUser (){
        $user = JWTAuth::user();
        if($user){
            // $data = Employee::where('user_id',$user->id)->get();
            $data = Employee::where('company_id',$user->company_id)->get(); //new
            return $this->generalResponse(true,$data,200);

        }
    }

}
