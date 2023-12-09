<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fcm_token',
        'status',
        'reset_code',
        'reset_date',
        'package_id',
        'subscription_to',
        'role',
        'image',
        'company_id',
        'position',
    ];
    protected $append = ['role_text'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value){

        $defaultImage =  asset('company/default.JPG');
        if($value == null){
            return $defaultImage;
        }else{
            return asset('clients/'.$value);
        }
   
       
       
    }
    public function getStatusAttribute($value){
        if($value == 1){
            return["text"=>"Active","color"=>"success"];
        }else{
            return["text"=>"Inactive","color"=>"danger"];
        }
    }
    public function getRoleTextAttribute(){
        if($this->role == 1){
            return 'Piflow Admin';
           
        }elseif($this->role== 2){
            return 'Admin';
        
        }elseif($this->role == 3){
            return 'Company Employee';
        
        }elseif($this->role == 4){
            return 'Piflow Accountant';
        }
    }
    public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [];
}

public function document(){
    return $this->hasMany(Document::class,'user_id');  
}
public function company(){
    return $this->belongsTo(Company::class,'company_id');
}
}
