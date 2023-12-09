<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Traits\filesTrait;
use App\Models\Metrics;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class metricsController extends Controller
{
    use filesTrait;
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
    public function create(Request $request)
    {
        // dd($request->all());
        $parsedDate = Carbon::parse($request->date);
        $date = $parsedDate;
        $company_id = $request->company_id;
        // $doc = Document::find($request->doc_id);
        $row=  Metrics::where('company_id',$company_id)
        ->whereMonth('date', '=', $parsedDate->month)
        ->whereYear('date', '=', $parsedDate->year)
        ->first();
// dd(json_decode($row->file));
        $fileData = [];
        if($row != null){
        if($row->file != null){
                $files = array_values(json_decode($row->file, true));
                $files_names = array_values(json_decode($row->file_name , true));
                            // dd(count($files),json_decode($data->file_name));
                            // dd($files);
                        if($files != null){
                            for($i=0; $i< (count($files)); $i++){
                            $fileData[] = [
                                'file_name' => $files_names[$i],
                                'file_path' =>  asset('metrics/'.$files[$i]),
                            ];
                        }
                        $row['files'] = $fileData;
                    }
        }
    }
// dd($row->files);




        // $fileData = [];
        // foreach ($row->file as $files) {
        //     dd($files);
        //     $filePaths = json_decode($files->file);
        //     $fileNames = json_decode($files->file_name);

        //     foreach ($filePaths as $index => $filePath) {
        //         $fileData[] = [
        //             'file_name' => $fileNames[$index],
        //             'file_path' =>  asset('metrics/'.$filePath)
        //         ];
        //     }
        // }
        return view('admin.metrics.create',compact('row','date','company_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $data = $request->validate([
            'total_sales' => ['required', 'string'],
            'total_purchases' => ['required', 'string'],
            'gross_margin' => ['required', 'string'],
            'net_profit' => ['required', 'string'],
            // 'balance'=>['numeric']
        ]);
        $data = $request->all();
        // dd($data);
        $row=  Metrics::where('date',$request->date)->first();
        // save multifiles

$path=[];
$fileName=[];
if($request->has('file')){
    $file = $request->file;
 

    foreach ($file as $index=>$f) {
        $path[$index] = $this->saveFiles($f,'metrics');
        $fileName[$index]= $f->getClientOriginalName();
    }

   

    if($row != null){
        $existingFilesArray = array_values(json_decode($row->file, true)?:[] ) ?? [];
        $existingNamesArray = array_values(json_decode($row->file_name, true) ?:[]) ?? [];
        $data['file'] = array_merge($existingFilesArray, $path);
        $data['file_name'] = array_merge($existingNamesArray, $fileName);
    }else{
            $data['file'] = $path;
            $data['file_name'] = $fileName;
    }

}
//    dd($path);
// end save multifiles


    //   $row=  Metrics::where('document_id',$request->document_id)->first();
      
        if($row){
                        $row->update($data);
        }else{
            Metrics::create($data);
        } 
        session()->flash('success', trans('Added successfully'));  
        return redirect()->back();
    }


    public function deleteFile($metrics_id , $file_id) {
        $metric = Metrics::findOrFail($metrics_id);

          $files = array_values(json_decode($metric->file, true));
          $files_names =array_values(json_decode($metric->file_name ,true));
        //   dd($files[$file_id]);
        File::delete(public_path('metrics/'.$files[$file_id]));   
        unset($files[$file_id]);
          unset($files_names[$file_id]);
          
        //   asset('metrics/'.$files[$i]),
          $metric->file = $files;
          $metric->file_name = $files_names;
          
          $metric->save();
          return redirect()->back();
          
        // dd($metric);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
