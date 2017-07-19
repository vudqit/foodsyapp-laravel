<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';
    public const PENDING  = 'pending';

    protected $fillable = [
    	'phone_number',
    	'status',
    	'user_id', 
        'place_id'
    ]; 

    public function user() 
    {
    	return $this->belongsTo('App\User'); 
    }

    public function place() 
    {
        return $this->belongsTo('App\Place');
    }

    public function orderDetails() 
    {
    	return $this->hasMany('App\OrderDetail'); 
    }
}
