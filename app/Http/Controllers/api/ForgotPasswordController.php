<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPassMail;
use Illuminate\Support\Str;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // $response = Password::sendResetLink($request->only('email'));
        $user = User::where('email',$request->email)->first();
if($user){
    
    $code =  mt_rand(1000, 9999);
    $user->update(['reset_code'=>$code,
                    'reset_date'=>Carbon::now()
                ]);
                $data=[
                        'code'=>$code,
                        'user'=>$user    
            ];
                $email = new ResetPassMail($data);
                Mail::to($request->email)->send($email);
                return response()->json(['message' => 'Reset password link sent to your email'], 200);
}else{
    return response()->json(['message' => 'Unable to send reset password link'], 400);
}
       
       



        // if ($response === Password::RESET_LINK_SENT) {
        //     return response()->json(['message' => 'Reset password link sent to your email'], 200);
        // } else {
        //     return response()->json(['message' => 'Unable to send reset password link'], 400);
        // }
    }
}
