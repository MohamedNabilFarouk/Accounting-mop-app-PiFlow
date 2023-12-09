<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
class ResetPasswordController extends Controller
{
    use GeneralTrait;
    public function checkCode(Request $request){
  

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }
    

        $user = User::where([['reset_code',$request->code],['reset_date','>=',Carbon::now()->subMinutes(60)]])->first();
        if($user){
            return $this->generalResponse(true,true,200);
        }else{
            return $this->generalResponse(true,false,200);  
        }
    }
   
   
    public function reset(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            // 'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Missing required fields'], 400);
        }

 //old api        // $user = User::where([['email',$request->email],['reset_code',$request->code],['reset_date','>=',Carbon::now()->subMinutes(60)]])->first();
        $user = User::where([['email',$request->email]])->first();
       
       
       
        // dd(Carbon::now()->subMinutes(60) < );
        // $response = Password::reset($request->only(
        //     'email', 'password', 'password_confirmation', 'code'
        // ), function ($user, $password) {
        //     $user->password = bcrypt($password);
        //     $user->save();
        // });




        if($user){
                $user->update(['password'=>bcrypt($request->password)]);
                return response()->json(['message' => 'Password reset successfully'], 200);
        }else{
        
            return response()->json(['message' => 'Unable to reset password'], 400); 
        }

        // if ($response === Password::PASSWORD_RESET) {
        //     // Generate a new token or unique identifier for the mobile app
        //     $token = generateToken(); // Replace with your token generation logic

        //     return response()->json(['message' => 'Password reset successfully', 'token' => $token], 200);
        // } else {
        //     return response()->json(['message' => 'Unable to reset password'], 400);
        // }
    }
}
