<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public const AVAILABLE    = 'available'; 
    public const UNAVAILABLE  = 'unavailable';

    protected $fillable = [
    	'message', 
    	'photo', 
    	'rating', 
    	'like', 
    	'user_id', 
    	'place_id',
    	'status'
    ]; 

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function place() 
    {
        return $this->belongsTo('App\Place');
    }
}
