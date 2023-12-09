<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Pos;
use App\Models\Justification;

class EmployeeController extends Controller
{

    public function getAllEmployeeOfUser (Request $request){
        $req = $request->all();
        // if($request->user_id){
        if($request->company_id){ //new
            if($request->category_id == 6){
            $data = Employee::where('company_id',$request->company_id)->paginate(20);
            $view = 'admin.employees.index';
        }elseif($request->category_id == 2){
            $data = Pos::where('company_id',$request->company_id)->paginate(20);
            $view = 'admin.pos.index';
            
        }elseif($request->category_id == 5){
            $data = Justification::where('company_id',$request->company_id)->paginate(20);
          
            $view = 'admin.justification.index';
            return view($view,compact('data','req'));
        }

        if ($data->isEmpty()) {
            session()->flash('Error', trans('No Files'));
            return redirect()->back();
        }
        return view($view,compact('data','req'));
    }
    }
}
