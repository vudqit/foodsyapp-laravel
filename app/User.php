<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * Attributes 
     *
     * @return String
     */
    // ROLE FIELDS 
    public const ROLE_USER   = 'user';
    public const ROLE_OWNER  = 'owner'; 
    public const ROLE_ADMIN  = 'admin'; 

    // STATUS FIELDS 
    public const AVAILABLE          = 'available'; 
    public const OWNER_REGISTRATION = 'pending';  
    public const UNAVAILABLE        = 'unavailable';

    // GENDER FIELDS 
    public const GENDER_MALE = 'm';
    public const GENDER_FEMALE = 'f';
    public const GENDER_NONE = 'n';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'display_name', 
        'email', 
        'password', 
        'phone_number', 
        'address', 
        'photo', 
        'gender', 
        'role', 
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function places() 
    {
        return $this->hasMany('App\Place');
    }

    public function comments() 
    {
        return $this->hasMany('App\Comment');
    }

    public function orders() 
    {
        return $this->hasMany('App\Order');
    }
}
