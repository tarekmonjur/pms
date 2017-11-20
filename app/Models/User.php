<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','password','designation','mobile_no','user_type','photo','status','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }


    public function getLastNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullNameAttribute(){
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }


    public function getUserRoleAttribute(){
        return ucfirst($this->user_type);
    }


    public function getFullPhotoAttribute(){
        if($this->photo) {
            return asset('/uploads/users/' . $this->photo);
        }else{
            return asset('/images/user.png');
        }
    }


    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M Y');
    }


}



