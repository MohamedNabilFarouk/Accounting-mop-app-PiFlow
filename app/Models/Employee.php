<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name','position','balance','company_id'];

    public function info(){
        return $this->hasMany(EmployeeInfo::class , 'employee_id');
    }
}
