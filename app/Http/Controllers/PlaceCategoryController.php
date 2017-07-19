<?php

namespace App\Http\Controllers;

use App\PlaceCategory;
use App\PlaceCategoryDetail; 
use App\Place; 

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PlaceCategoryController extends ApiController
{
    private $placeCategory; 

    public function __construct(PlaceCategory $placeCategory) 
    {
        $this->placeCategory = $placeCategory; 
    }

    public function getAll()
    {
        $placeCategories = PlaceCategory::all(); 

        return $this->listResponse($placeCategories);
    }

    public function getPlaces($name, Request $request) 
    {
        $placeCategories = PlaceCategory::all()->where('description', $name);
        $placeCategoryDetails = []; 
        $placesJson = []; 
        
        foreach ($placeCategories as $placeCategory) {
            foreach ($placeCategory->placeCategoryDetails as $placeCategoryDetail) {
                array_push($placeCategoryDetails, $placeCategoryDetail);
            }    
        }

        foreach ($placeCategoryDetails as $item) {
            $latitude = $request->latitude; 
            $longitude = $request->longitude; 
            $place = $item->place;
            $distance = $this->distance($latitude, $longitude, $place->latitude, $place->longitude); 
            $minutes = $this->minutesCalculateForDistance($distance); 
            
            if ($place->status == Place::AVAILABLE) {
                array_push($placesJson, [
                    'place' => $place, 
                    'minutes' => $minutes
                ]);
            }
        }
        
        return $this->listResponse($placesJson);
    } 

     // Get distance between 2 cordinates -> km 
    private function distance($lat1, $lon1, $lat2, $lon2) 
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper('K');
      
        return ($miles * 1.609344);
    }
    
    private function minutesCalculateForDistance($distance) {
        // Assume the car drive in 40km/hour
        // Return time for minutes 
        return ($distance / 20) * 60; 
    }
}
