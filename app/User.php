<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

    const VARIFIED_USER = '1';
    const UNVARIFIED_USER = '0';
    const ADMIN_USER ='true';
    const REGULER_USER = 'false';
    
    
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 'email', 'password','varified','varification_token','admin'
    ];

    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name){
        return ucwords($name); 
    }

    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function isVarified(){
       return $this->varified == User::VARIFIED_USER;

    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationToken(){
        return str_random(40);
    } 
}
