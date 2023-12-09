<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Document;
use App\Models\Company;
use App\Models\Package;
use App\Models\Category;
use App\Models\DocFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

// use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    //
    public function index(){
        $users = User::whereIn('role',['1','4'])->orderBy('id','desc')->paginate(20);
        return view('admin.user.index',compact('users'));
    }


    public function create(){
      
        return view('admin.user.create');
    }

    protected function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'balance'=>['numeric']
        ]);
        // dd($data['password']);

     

        $data = $request->all();
       
        $data['password'] = Hash::make($data['password']);

        try{
            DB::beginTransaction();
        $user =  User::create($data);
        if($request->role != null){
                $role = Role::findById($request->role);
                $user->assignRole($role); // role 1 and 4 
        }
            session()->flash('success', trans('added successfully'));
            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            session()->flash('Error', trans('Error in Create acccount'));
        }
            
            return redirect()->route('user.index');
        // }

    }


    public function edit($id){
        $user = User::findOrFail($id);
        return view ('admin.user.edit',compact('user'));
    }

    public function update(Request $request,$id){
// dd($request);
        $data = $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        //   'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$id],
          'password' => ['string','nullable', 'min:8', 'confirmed'],

        ]);
        
        $user = User::findOrFail($id);
        $data = $request->except('password');
        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }   
      
        $user->update($data);
        session()->flash('success', trans('updated successfully'));

      
            return redirect()->back();
       


    }





 
   

    public function userDates($company_id){
        

        $dates = Document::select(DB::raw("DATE_FORMAT(date, '%b %Y') as date"),'company_id')
            ->where('company_id', $company_id)
            ->get()
            ->unique('date');
            // dd($dates);
        return view('admin.user.dates',compact('dates'));
    }

// old function get only categories that contain files

    public function getUserDateCategory($company_id , $date){
        $parsedDate = Carbon::parse($date);
        $rows = Document::with('category')
        ->where('company_id', $company_id)
        ->whereMonth('date', '=', $parsedDate->month)
        ->whereYear('date', '=', $parsedDate->year)
        ->get()
        ->unique('category_id')
        ->values();
     
            return view('admin.user.categories',compact('rows'));
        }

        // get all categories
        public function getCategories($company_id,$date){
            $parsedDate = Carbon::parse($date);
            $hasfile = Document::with('category')
            ->where('company_id', $company_id)
            ->whereMonth('date', '=', $parsedDate->month)
            ->whereYear('date', '=', $parsedDate->year)
            ->get()
            ->unique('category_id')
            ->pluck('category_id')->toArray();
            

            $rows= Category::all();
            return view('admin.user.categories',compact('rows','company_id','date','hasfile'));

        }



        public function getFiles(Request $request){
            // dd($request->all());
            $document = Document::where('company_id', $request->company_id)->with(['files','info'])
            ->where('category_id', $request->category_id)
            ->where('pos_id', $request->pos_id)
            ->where('justification_id', $request->justification_id)
            ->where(function($query)use($request){
                if($request->has('employee_id')){
                      $query->WhereHas('info', function($q)use($request){
                    $q->Where('employee_id',$request->employee_id);
            });
                }
            })    
            ->whereMonth('date', Carbon::parse($request->date)->month)
            ->whereYear('date', Carbon::parse($request->date)->year)->with('info')
            ->get();
            //  dd($document);
                if($document == '[]'){
                    session()->flash('Error', trans('No Files'));
                    return redirect()->back();
                }

        $fileData = [];

        foreach($document as $doc){
            foreach ($doc->files as $file) {
                // $fileData[] = [$file->file_name=> $file->file];
                $fileData[] = $file;
            }
        }



//         foreach ($document as $file) {
//             $filePaths = array_values(json_decode($file->file, true));
//             $fileNames = array_values(json_decode($file->file_name, true));
// // dd($filePaths);
//             foreach ($filePaths as $index => $filePath) {
//                 $fileData[] = [
//                     'document_id' => $file->id,
//                     'file_name' => $fileNames[$index],
//                     'file_path' =>  asset('documents/'.$filePath)
//                 ];
//             }

            
//         }
// dd($document);

         // change response if category petty cashe to get employee info with files
        //  if(($request->employee_id != null) && $request->category_id == 6){
        //     $employee_info=$document->info;
        //     return view('admin.user.files',compact('fileData','document','employee_info'));
        // }



       

        return view('admin.user.files',compact('fileData','document'));

         }



         public function userActivation(Request $request){
            $user = User::findOrFail($request->userId);
            if($user->status['text'] == 'Inactive'){
                $user->update([
                    'status'=>1,
                ]);
            }else{
                $user->update([
                    'status'=>0
                ]);
            }
            return response()->json(['data' => $user]);
         }
         public function companyActivation(Request $request){
            $company = Company::findOrFail($request->companyId);
            if($company->status['text'] == 'Inactive'){
                $company->update([
                    'status'=>1,
                ]);
            }else{
                $company->update([
                    'status'=>0
                ]);
            }
            return response()->json(['data' => $company]);
         }



    public function destroy( $id){

        $user = User::find($id);
        // $user_provider = Provider::where('user_id',$id)->get();
        DB::beginTransaction();
        //$user->detachRole($user->roles[0]->name); // parameter can be a Role object, array, id or the role string name
         $user->delete();
        //  foreach($user_provider as $u){
        //     $u->delete();
        //  }

         DB::commit();
        // $user->roles()->attach(['customer']);

        session()->flash('success', trans('deleted successfully'));
        return redirect()->route('user.index');
    }
    public function deleteFile($file_id) {
       DocFile::where('id',$file_id)->delete();
       session()->flash('success', trans('deleted successfully'));
          return redirect()->back();
      
        
    }

    public function getCompanyAccount($company_id){
      $rows= User::where('company_id',$company_id)->paginate(20);
 
        return view('admin.company.accounts',compact('rows'));
    }


}
