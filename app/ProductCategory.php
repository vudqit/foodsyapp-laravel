<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    //
    protected $fillable = [
    	'name', 
    	'description',
        'place_id', 
    	'status'
    ]; 

    public function place() 
    {
        return $this->belongsTo('App\Place');
    }

    public function products() 
    {
    	return $this->hasMany('App\Product', 'category_id');
    }
}
