<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Document;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function create(){
      
        $packages = Package::all();
        return view('admin.company.create',compact('packages'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'balance'=>['numeric']
        ]);
        // dd($data['password']);

     

        $data = $request->except('_token', 'method', 'package_id','subscription_to','company_name','com_register','tax_register');
       
        $data['password'] = Hash::make($data['password']);

        if(($request->package_id != null) && ($request->subscription_to == null)){
            $package = Package::find($request->package_id);
            $subscription_to = Carbon::now()->addDays($package->duration);
        }else{
            $subscription_to = $request->subscription_to;
        }
        try{
            DB::beginTransaction();
        $company = Company::create([
            'name' => $request->company_name,   
            'package_id' => $request->package_id,   
            'subscription_to' => $subscription_to, 
            'com_register'=>$request->com_register,   
            'tax_register'=>$request->tax_register,   
        ]);
        if($company){
            $data['company_id']=$company->id;
        }
        $user =  User::create($data);
        DB::commit();
        session()->flash('success', trans('added successfully'));
    }catch(Exception $e) {
        DB::rollBack();
        session()->flash('Error', trans('Error in Create new Company'));
    }
       
          
            return redirect()->route('home');
     

    }

    public function edit($id){
        $company = Company::findOrFail($id);
        $packages = Package::all();
        return view ('admin.company.edit',compact('company','packages'));
    }


    public function update(Request $request,$id){
        // dd($request);
                $data = $request->validate([
                  'name' => ['required', 'string', 'max:255'],
                  'tax_register' => ['string','nullable', 'max:255'],
                  'com_register' => ['string','nullable', 'max:255'],
                ]);
                $company = Company::findOrFail($id);
             
        
                if(($request->package_id != null) && ($request->subscription_to == null)){
                    $package = Package::find($request->package_id);
                    $subscription_to = Carbon::now()->addDays($package->duration);
                }else{
                    $subscription_to = $request->subscription_to;
                }
               if($company){
                $company->update([
                    'name' => $request->name,   
                    'package_id' => $request->package_id,   
                    'subscription_to' => $subscription_to,   
                    'com_register'=>$request->com_register,   
                    'tax_register'=>$request->tax_register,   
                ]);
            }
                session()->flash('success', trans('updated successfully'));
                    return redirect()->route('home');
               
        
        
            }
}
