<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    use HasFactory;

    protected $table='employee_info';
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    // public function document(){
    //     return $this->hasOne(Document::class,'id','document_id');
    // }
}
