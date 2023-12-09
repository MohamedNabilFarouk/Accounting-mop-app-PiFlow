<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\filesTrait;
use App\Traits\GeneralTrait;
use App\Models\Document;
use App\Models\Category;
use App\Models\Metrics;
use App\Models\EmployeeInfo;
use App\Models\Pos;
use App\Models\DocFile;
use App\Models\Justification;
use App\Http\Resources\DocumentResource;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\File;
class DocumentController extends Controller
{
    use filesTrait;
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
   
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate required fields
    $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'company_id' => 'required', //new
        'category_id' => 'required',
        'file' => 'required',
        'date' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Missing required fields'], 400);
    }

// save multifiles
// $path=[];
// $fileName=[];
// if($request->has('file')){
//     $file = $request->file;


//     foreach ($file as $f) {
//         $path[] = $this->saveFiles($f,'documents');
//         $fileName[]=$f->getClientOriginalName();
//     }
// }

// end save multifiles

    // Store the data in the documents table

    // $request->file = $this->saveFiles($request->file,'documents');
    
    try{
        DB::beginTransaction();
        $dateString = $request->date;
        $date = Carbon::createFromFormat('M Y', $dateString)->startOfMonth();



if($request->document_id == null){

    $document = new Document;
    $document->user_id = $request->user_id;
    $document->company_id = $request->company_id; // new
    $document->category_id = $request->category_id;
    $document->date = $date;
    // $document->file =json_encode($path);
    // $document->file_name = json_encode($fileName);
    if($request->has('pos_id')){
        $document->pos_id= $request->pos_id ;
    }
    if($request->has('justification_id')){
        $document->justification_id= $request->justification_id ;
    }
  
    $document->save();

 // new saving files
 if($request->has('file')){
    $file = $request->file;
    $file_data['document_id'] =  $document->id ;
foreach ($file as $f) {
    
    $file_data['file_name'] = $f->getClientOriginalName();
    $file_data['file'] = $this->saveFiles($f,'documents');
    DocFile::create($file_data); 
 
       
}
}


    if(($request->employee_id != null)&&($request->category_id == 6)){ //petty cashe category store employee info 
      $info = new EmployeeInfo;
      $info->document_id = $document->id;
      $info->employee_id = $request->employee_id;
      $info->amount = $request->amount;
      $info->des = $request->des;
      $info->trans_date = $request->trans_date;
      $info->save();
    }
    if(($request->category_id == 5)&& ($request->has('justification_id'))){  //justification  category store just info 
        // $info = new Justification;
        // // $info->doc_id = $document->id;
        // // $info->user_id = $document->user_id;
        // // $info->bank_name = $request->bank_name;
        // // $info->bank_number = $request->bank_number;
        // $info->piflow_comment = $request->piflow_comment;
        // $info->client_comment = $request->client_comment;
        // $info->des = $request->des;
        // // $info->date = $request->trans_date;
        // // $info->icon = $request->icon;
        // $info->save();

        $info = Justification::findOrFail($request->justification_id);
        $info->update($request->all());
    }

}else{
    // update document
    $document = Document::findOrFail($request->document_id);
     // new saving files
 if($request->has('file')){
    $file = $request->file;
    $file_data['document_id'] =  $document->id ;
foreach ($file as $f) {
    
    $file_data['file_name'] = $f->getClientOriginalName();
    $file_data['file'] = $this->saveFiles($f,'documents');
    DocFile::create($file_data); 
       
}
}

if(($request->employee_id != null)&&($request->category_id == 6)){ //petty cashe category update employee info 
   $info = EmployeeInfo::where('document_id',$document->id)->latest();
    $info->update([
        'amount' => $request->amount,
        'des' => $request->des,
        'trans_date' => $request->trans_date
    ]);
  }

  if(($request->category_id == 5)&& ($request->has('justification_id'))){  //justification  category store just info 
    $info = Justification::findOrFail($request->justification_id);
    $info->update($request->all());
}

    
}
DB::commit();
    return $this->generalResponse(true,'Document stored successfully',200);
}catch(Exception $e) {
    DB::rollBack();
    return $this->generalResponse(false,'Error in Storing Files ',400);
}
    // Return a JSON response
    
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserDate(Request $request)
    {
        $dates = Document::select('id',DB::raw("DATE_FORMAT(date, '%b %Y') as date"))
            // ->where('user_id', $request->user_id)
            ->where('company_id', $request->company_id) //new
            ->get('id', 'date')
            ->unique();
            // return $documents;
            return $this->generalResponse(true,$dates,200); 
    }

            public function getUserDateCategory(Request $request){
                $parsedDate = Carbon::parse($request->date);
                $row = Document::with('category')
                // ->where('user_id', $request->user_id)
                ->where('company_id', $request->company_id)  // new
                ->whereMonth('date', '=', $parsedDate->month)
                ->whereYear('date', '=', $parsedDate->year)
                ->get()
                ->unique('category_id')
                ->values();
                    return $this->generalResponse(true,
                    DocumentResource::collection($row),
                    200);    
                }

                public function getFiles(Request $request){
            // $files = Document::where('user_id', $request->user_id)
            $document = Document::where('company_id', $request->company_id) //new
            ->where('category_id', $request->category_id)
            ->where('pos_id', $request->pos_id)
            ->where('justification_id', $request->justification_id)->with('files')
            //  ->orWhereHas('info', function($q)use($request){
            //         $q->Where('employee_id',$request->employee_id);
            // })
            ->where(function($query)use($request){
                if($request->has('employee_id')){
                      $query->WhereHas('info', function($q)use($request){
                    $q->Where('employee_id',$request->employee_id);
            });
                }
            })    
            ->whereMonth('date', Carbon::parse($request->date)->month)
            ->whereYear('date', Carbon::parse($request->date)->year)->with(['info'])
            ->get();
//    dd($document);
        $fileData = [];
if(!($document->isEmpty())){
   
// foreach($document as $doc){
//     foreach ($doc->files as $file) {
//         // $filePaths[] = $file->file;
//         // $fileNames[] = $file->file_name;
//         $fileData[] = $file;
//     }
// }
// dd($fileData[0]);


        // foreach ($document->files as $file) {
        //     $filePaths = $file->file;
        //     $fileNames = $file->file_name;

        //     foreach ($filePaths as $index => $filePath) {
        //         $fileData[] = [
        //             'document_id'=>$file->id,
        //             'file_name' => $fileNames[$index],
        //             'file_path' =>  asset('documents/'.$filePath),
        //         ];
                
        //     }

    
    

        // }
        // dd($fileData);
}else{
    
    return $this->generalResponse(true,[],200);
}

//         // change response if category petty cashe to get employee info with files
//         if(($request->employee_id != null) && $request->category_id == 6){
//             // $employee_info=$document[0]->info;
//             return $this->generalResponse(true,DocumentResource::collection($document),200);
//         }
// // change response if category justificationto get just info with files
//         if(($request->justification_id != null) && $request->category_id == 5){
//             // $justification_info=$file->just_info;
//             $justification_info=Justification::where('id',$document->justification_id)->first();
//             return $this->generalResponse(true,['files'=>$fileData,'info'=>$justification_info],200);
//         }
// // change response if category pos get pos info with files
//         if(($request->pos_id != null) && $request->category_id == 2){
//             $pos_info=Pos::where('id',$document->pos_id)->first();
//             return $this->generalResponse(true,['files'=>$fileData,'info'=>$pos_info],200);
//         }


        return $this->generalResponse(true, DocumentResource::collection($document),200);

         }


         public function getMetrics(Request $request){
            // $data =  Metrics::where('document_id',$request->doc_id)->first();
            $parsedDate = Carbon::parse($request->date);
        //   $data=  Metrics::where('user_id',$request->user_id)
          $data=  Metrics::where('company_id',$request->company_id) // new
            ->whereMonth('date', '=', $parsedDate->month)
            ->whereYear('date', '=', $parsedDate->year)
            ->first();
            $fileData = [];
            if($data){
                    $files = json_decode($data->file);
                    $files_names = json_decode($data->file_name);
                                // dd(count($files),json_decode($data->file_name));
                            if($files != null){
                                for($i=0; $i< (count($files)); $i++){
                                $fileData[] = [
                                    'file_name' => $files_names[$i],
                                    'file' =>  asset('metrics/'.$files[$i]),
                                ];
                            }
                            $data['files'] = $fileData;
                        }
            }

            return $this->generalResponse(true,$data,200);
         }

         public function getcategories(){
          $data  = Category::all();
          return $this->generalResponse(true,$data,200);

         }

         public function deleteFile( Request $request){
            $validator = Validator::make($request->all(), [
                'file_id' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => 'Missing required fields'], 400);
            }
          
            $row = DocFile::with('document')->findOrFail($request->file_id);
            // dd(JWTAuth::user());
if($row->document->company_id == JWTAuth::user()->company_id){

          $row->delete();
            return $this->generalResponse(true,'Document Updated successfully',200);
}else{
    return $this->generalResponse(false,'There is no Access',400);
}
            
         }

    }
