<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFile extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='files';
    public function document(){
        return $this->belongsTo(Document::class,'document_id');
    }

    public function getFileAttribute($value){
        return asset('documents/'.$value);
    }
}
