<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Document;
use App\Models\Pos;
use App\Models\Justification;
class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $info='';
        if(($request->employee_id != null) && $request->category_id == 6){
            $info=$this->info;
        }else  if(($request->justification_id != null) && $request->category_id == 5){
            $info=Justification::where('id',$this->justification_id)->first();
        }else  if(($request->pos_id != null) && $request->category_id == 2){
            $info=Pos::where('id',$this->pos_id)->first();
        }else{
            $info='';
        }
        
        // $this->user;
        // return parent::toArray($request);
        return [
           'document_id'=>$this->id,
        //    'user_id'=>$this->user_id,
        //    'category_id'=>$this->category->id,
        //    'category_name'=>$this->category->title,
           'files'=>$this->files ?? [],
           'info'=>$info,
        //    'company'=>$this->company,

        ];

    }
}
