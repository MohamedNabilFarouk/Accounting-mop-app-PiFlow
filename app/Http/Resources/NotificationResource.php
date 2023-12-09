<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       

        
        // $this->user;
        // return parent::toArray($request);
        return [
           'title'=>$this['data']['details']['title'],
           'body'=>$this['data']['details']['body'],
           'type'=>$this['data']['details']['type'],
           'at'=>Carbon::parse($this->created_at)->format('d-m-Y h:i A')
        
        ];

    }
}
