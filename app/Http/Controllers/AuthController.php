<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use Laravel\Socialite\Facades\Socialite;
use App\Provider;

use JWTAuth;
use App\Models\User;
use Validator;
use Str;
use DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','socialLogin']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // dd($request->identify);

        $value = request()->input('identify'); // email@gmail  or 293293923293

        $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        request()->merge([$field =>$value ]);

        // if(User::where('email',$value)->pluck('role')->first() !='2'){
        //     return response()->json(['error'=>'Unauthorised User'],400);
        // }
        if (!in_array(User::where([['email', $value],['status','1']])->whereHas('company',function($q){
            $q->where('status','1');
        })->pluck('role')->first(), ['2', '3'])) {
            return response()->json(['error'=>'Unauthorised User'],400);
        }
       

        $credentials = request([$field, 'password']);
        // dd($credentials);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Error In Email Or Password'], 400);
        }
        
        if($request->has('fcm_token')){
            $fcm_token = $request->fcm_token;
            $user = Auth::guard('api')->user();
            $user->update(['fcm_token'=> $fcm_token]);
            }


        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request) {



        if  (Auth::guard('api')->check() == false){
            return response()->json(['error'=>'Unauthorised User'],400);
        }
      
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'company_id' => 'required',
        ]);
     

        if($validator->fails()){
           
            return response()->json(['error' => $validator->errors()], 400);
        }

      


        $data = $request->all();
       

    try{
        DB::beginTransaction();
  
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'position' => $data['position'],
            'role'=>3,
            'company_id' => $data['company_id'],
            'password' => Hash::make($data['password']),
            
        ]);

        $user->syncRoles(['Company Employee']);

        // $credentials = request(['email', 'password']);
        // // dd($credentials);

        // // $token = Auth::login($user);


        // if (! $token = auth()->guard('api')->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 400);
        // }

        if($request->has('fcm_token')){
            // dd('here');
            $fcm_token = $request->fcm_token;
            $user->update(['fcm_token'=> $fcm_token]);
            }
            
        // return $this->respondWithToken($token);
        DB::commit();
        return response()->json(['message' => 'Employee Added successfully']);
        }catch(Exception $e) {
            DB::rollBack();
            return $this->generalResponse(false,'Error try again later ',400);
        }
    }




    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = JWTAuth::user();
       
        $user->update(['fcm_token'=>null]);
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::guard('api')->user();
        $user->company;
        return response()->json([
            'data'=>$user,
            'access_token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function changePassword(Request $request)
{
    $user = JWTAuth::user();

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    if($validator->fails()){
        return response()->json(['message' => $validator->errors()->toJson()], 400);
    }

    // Verify the current password
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect', 401]);
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password changed successfully']);
}


// *****************************************************************************************


    public function socialLogin(Request $request)
{

    $provider = $request->input('provider'); // or $request->input('provider_name') for multiple providers
    $token = $request->input('access_token');    // get the provider's user. (In the provider server)
    $providerUser = Socialite::driver($provider)->userFromToken($token);    // check if access token exists etc..    // search for a user in our server with the specified provider id and provider name
//    dd($providerUser);
    $user = Provider::where('provider', $provider)->where('provider_id', $providerUser->id)->first();    // if there is no record with these data, create a new user
    //dd($user);
    if($user == null){
        // dd('if');

        // $check_user = User::where('email',$providerUser->getEmail())->first();

        // if($check_user != null){
        //     return response()->json(['success'=>'false','data'=>'The email has already been taken']);
        // }


            $userGetReal = new User;
            $userGetReal->name=$providerUser->getName();
            $userGetReal->email=$providerUser->getEmail();

            if($request->has('fcm_token')){
            $fcm_token = $request->fcm_token;
            $userGetReal->fcm_token = $fcm_token;
            }

            $userGetReal->save(); //save in users table

            $userGetReal->attachRole(5); // customer default

            $provider_user = new Provider ;
            $provider_user->provider_id= $providerUser->getId();
            $provider_user->provider= $provider;
            $provider_user->user_id= $userGetReal->id;
            $provider_user->save(); //save in providers table
            // $token = $userGetReal->createToken(env('APP_NAME'))->accessToken;
    }    // create a token for the user, so they can login

    else{
        // dd('else');
        // login
        $userGetReal = User::find($user->user_id);

        if($request->has('fcm_token')){
            $fcm_token = $request->fcm_token;
            $userGetReal->update(['fcm_token'=> $fcm_token]);
            }

        // $token = $user->createToken(env('APP_NAME'))->accessToken;
    }

    //  $token = $user->createToken(env('APP_NAME'))->accessToken;    // return the token for usage
    return response()->json([
        'success' => true,
        'data' => $userGetReal
    ]);
}

}
