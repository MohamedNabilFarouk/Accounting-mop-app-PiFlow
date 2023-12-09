<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ClientEmp extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'client_emp';
    protected $fillable = [
        'name',
        'email',
        'password',
        'fcm_token',
        // 'status',
        // 'reset_code',
        // 'reset_date',
        // 'package_id',
        // 'subscription_to',
        // 'role',
        // 'image',
    ];

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
            return asset('clients/'.$value);
    }
    public function getStatusAttribute($value){
        if($value == 1){
            return["text"=>"Active","color"=>"success"];
        }else{
            return["text"=>"Inactive","color"=>"danger"];
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
public function user(){
    return $this->belongsTo(User::class,'user_id');  
}
}
