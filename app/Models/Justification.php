<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    use HasFactory;
    protected $fillable=['bank_name','bank_number','des','piflow_comment','client_comment','trans_date','company_id'];


    // public function document(){
    //     return $this->belongsTo(Document::class,'doc_id');
    // }
}
