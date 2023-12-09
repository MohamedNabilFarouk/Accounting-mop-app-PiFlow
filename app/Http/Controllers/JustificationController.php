<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;
use App\Traits\filesTrait;
use Carbon\Carbon;
use Validator;
class JustificationController extends Controller
{
    use filesTrait;
    public function create(Request $request)
    {
        $parsedDate = Carbon::parse($request->date);
        $date = $parsedDate;
        $company_id = $request->company_id;
            return view('admin.justification.create',compact('date','company_id'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bank_number' => 'required',
            'piflow_comment' => 'string',
            'des' => 'string',
            'trans_date' => 'required|string',
        
        ]);

        Justification::create($request->all());
        session()->flash('success', trans('Added successfully'));  
        return redirect()->back();
    }

    public function edit($id){
        $row = Justification::findOrFail($id);
        return view ('admin.justification.edit',compact('row'));
    }

    public function update(Request $request,$id){
// dd($request);
$validator = Validator::make($request->all(), [
    'bank_name' => 'required',
    'bank_number' => 'required',
    'piflow_comment' => 'string',
    'des' => 'string',
    'trans_date' => 'required|string',

]);
        
        $row = Justification::findOrFail($id);
        $data = $request->all();
        $row->update($data);
        session()->flash('success', trans('updated successfully'));

      
            return redirect()->back();
       
    }


}
