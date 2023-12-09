<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Traits\GeneralTrait;

class PackagesController extends Controller
{
    use GeneralTrait;
    public function getPackages(){
        $packages = Package::all();
        return $this->generalResponse(true,$packages,200);  
    }


}
