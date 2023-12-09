<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
 
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function files(){
        return $this->hasMany(DocFile::class,'document_id');
    }
    public function info(){
        return $this->hasOne(EmployeeInfo::class , 'document_id');
    }
    // public function just_info(){
    //     return $this->hasOne(Justification::class , 'doc_id');
    // }
  
  
}
