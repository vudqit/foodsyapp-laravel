<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceCategoryDetail extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';
    
    //
    protected $fillable = [
    	'place_id', 
    	'category_id',
    	'status'
    ]; 

    public function place() 
    {
    	return $this->belongsTo('App\Place'); 
    }

    public function placeCategory() 
    {
    	return $this->belongsTo('App\PlaceCategory'); 
    }
}
