<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metrics extends Model
{
    use HasFactory;
    protected $table = 'metrics';
    protected $guarded =[];

    // public function document(){
    //     return $this->hasMany(Document::class ,'document_id');
    // }

}
