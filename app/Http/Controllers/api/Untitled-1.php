<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\filesTrait;
use App\Traits\GeneralTrait;
use App\Models\Document;
use App\Models\File;
use App\Http\Resources\DocumentResource;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
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
        'category_id' => 'required',
        'file' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Missing required fields'], 400);
    }


// $path=[];
// $fileName=[];




    // Store the data in the documents table

    // DB::beginTransaction();   
            try {    
    $document = new Document;
    $document->user_id = $request->user_id;
    $document->category_id = $request->category_id;
    $document->save();
   
    if($document){
        // save multifiles
        if($request->has('file')){
            $file = $request->file;
        
        
            foreach ($file as $f) {
                $file_doc = new File;  
                $file_doc->title = $f->getClientOriginalName();
                $file_doc->file =$this->saveFiles($f,'documents');
                $file_doc->document_id =$document->id ;
                $file_doc->save();
                   
            }
            // end save multifiles
        }

    }
     // Return a JSON response
     DB::commit();
     return $this->generalResponse(true,'Document stored successfully',200);
}catch(\Exception $e) {
    DB::rollback();
    
    return $this->generalResponse(false,'Error In Upload Documents',200);
}

   
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserDate($userId)
    {
        $dates = Document::select(DB::raw("DATE_FORMAT(created_at, '%b %Y') as date"))
            ->where('user_id', $userId)
            ->pluck('date')
            ->unique();
            // return $documents;
            return $this->generalResponse(true,$dates,200); 
    }

    public function getUserDateCategory($userId,$date){
        $parsedDate = Carbon::parse($date);
        $row = Document::with('category')
        ->where('user_id', $userId)
        ->whereMonth('created_at', '=', $parsedDate->month)
        ->whereYear('created_at', '=', $parsedDate->year)
        ->get()
        ->unique('category_id')
        ->values();
            return $this->generalResponse(true,
            DocumentResource::collection($row),
            200); 
    }

    public function getFilesByCategory($userId,$date,$category_id){
        $parsedDate = Carbon::parse($date);
        $row = Document::with('file')
        ->where('user_id', $userId)
        ->where('category_id', $category_id)
        ->whereMonth('created_at', '=', $parsedDate->month)
        ->whereYear('created_at', '=', $parsedDate->year)
        ->whereHas('file',function($q){
            $q->where('document_id',)
        })
        ->get();
        return $this->generalResponse(true,
        $row,
        200); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
