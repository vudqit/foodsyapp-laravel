<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    protected $fillable = [
    	'quantity', 
    	'order_id', 
    	'product_id',
    	'status'
    ]; 

    public function order() 
    {
    	return $this->belongsTo('App\Order');
    }

    public function product() 
    {
    	return $this->belongsTo('App\Product');
    }
}
