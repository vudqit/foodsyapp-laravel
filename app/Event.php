<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';
    public const PENDING      = 'pending'; 

    protected $fillable = [
    	'title',
        'content',   
    	'photo', 
    	'sale', 
        'time_start', 
        'time_end', 
        'place_id',
        'status'
    ]; 

    public function place() 
    {
        return $this->belongsTo('App\Place');
    }
}
