<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    public const TO_DRINK = 'drink';
    public const TO_EAT = 'eat';
    public const TO_ENTERTAIN = 'entertain'; 

    protected $fillable = [
    	'name', 
    	'description', 
    	'photo', 
    	'price', 
    	'type',
    	'status',
        'category_id', 
    ]; 

    public function productCategory() 
    {
        return $this->belongsTo('App\ProductCategory'); 
    }

    public function orderDetails() 
    {
        return $this->hasMany('App\OrderDetail');
    }
}
