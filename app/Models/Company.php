<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function getImageAttribute($value){

        $defaultImage =  asset('company/default.JPG');

        if($value == null){
            return $defaultImage;
        }else{
            return asset('company/'.$value);
        }

     
        
}

    public function user(){
        return $this->hasMany(User::class,'company_id');
    }

    public function getStatusAttribute($value){
        if($value == 1){
            return["text"=>"Active","color"=>"success"];
        }else{
            return["text"=>"Inactive","color"=>"danger"];
        }
    }
    


}
