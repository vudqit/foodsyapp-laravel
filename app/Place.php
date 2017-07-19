<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    //
    protected $fillable = [
    	'display_name', 
    	'description', 
    	'address', 
        'city',
    	'phone_number', 
    	'email', 
    	'photo', 
    	'price_limit', 
    	'time_open', 
    	'time_close', 
    	'wifi_password', 
    	'latitude', 
    	'longitude', 
    	'status', 
    	'user_id'
    ]; 

    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function placeCategoryDetails() 
    {
        return $this->hasMany('App\PlaceCategoryDetail'); 
    }

    public function productCategories() 
    {
        return $this->hasMany('App\ProductCategory'); 
    }

    public function comments() 
    {
        return $this->hasMany('App\Comment'); 
    }

    public function events() 
    {
        return $this->hasMany('App\Event');
    }

    public function orders() 
    {
        return $this->hasMany('App\Order');
    }
}
