<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    public const TO_DRINK = 'drink';
    public const TO_EAT = 'eat';
    public const TO_ENTERTAIN = 'entertain'; 
    //
    protected $fillable = [
    	'name', 
    	'description',
    	'status'
    ]; 

    public function placeCategoryDetails() 
    {
    	return $this->hasMany('App\PlaceCategoryDetail', 'category_id');
    }
}
