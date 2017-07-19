<?php

namespace App\Http\Controllers;

use App\User;
use App\Place;
use App\PlaceCategory;
use App\PlaceCategoryDetail;
use App\ProductCategory;
use App\Product;
use App\Order; 


use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PlaceController extends ApiController
{
    private $place;

    public function __construct(Place $place) 
    {
        $this->place = $place; 
    }

    // MARK: - Database Methods
    public function getPlace($id) 
    {
        $place = $this->place->findOrFail($id);

        return $this->showResponse($place);
    }

    public function getPlaces(Request $request)
    {
        $places = $this->place->all(); 
        $placesJson = []; 

        if ($request->latitude != null && $request->longitude != null) {
            $latitude = $request->latitude; 
            $longitude = $request->longitude; 

            foreach ($places as $place) {
                $distance = $this->distance($latitude, $longitude, $place->latitude, $place->longitude); 
                $minutes = $this->minutesCalculateForDistance($distance); 
                $rating = 0; 
                $amount = 0; 
                foreach ($place->comments as $comment) {
                    $amount = $amount + 1; 
                    $rating = $rating + $comment->rating; 
                }
                unset($place->comments);
                $amount = $amount == 0 ? 1 : $amount; 
                $rating = $rating / $amount; 
                array_push($placesJson, [
                    'place'     => $place, 
                    'minutes'   => $minutes, 
                    'rating'    => $rating
                ]);
            }
        } else {
            $placesJson = $places; 
        }
        
        return $this->listResponse($placesJson);
    }

    public function store(Request $request)
    {
        $token = $request->token; 
        $this->checkUserHasOwnerPermission($token);
        $user = $this->getAuthUser($token);

        $rule = [
            'display_name'  => 'required|min:6', 
            'photo'         => 'image', 
            'email'         => 'email', 
            'category_id'   => 'required',
        ]; 

        $this->validate($request, $rule); 

        $placeCategory = PlaceCategory::findOrFail($request->category_id); 

        $photo = null; 
        if ($request->photo) {
            $photo = $request->photo->store(''); 
        }

        $place = new Place(); 

        $place->display_name    = $request->display_name; 
        $place->description     = $request->description; 
        $place->address         = $request->address;
        $place->city            = $request->city;
        $place->phone_number    = $request->phone_number; 
        $place->email           = $request->email; 
        $place->photo           = $photo;
        $place->price_limit     = $request->price_limit; 
        $place->time_open       = $request->time_open; 
        $place->time_close      = $request->time_close; 
        $place->wifi_password   = $request->wifi_password; 
        $place->latitude        = $request->latitude; 
        $place->longitude       = $request->longitude;  
        $place->user_id         = $user->id;
         
        $place->save(); 

        PlaceCategoryDetail::create([
            'place_id'      => $place->id, 
            'category_id'   => $request->category_id
        ]); 

        return $this->showResponse($place);
    }

    public function update(Request $request)
    {
        $this->checkUserHasOwnerPermission($request->token);

        $place = $this->place->findOrFail($request->id); 

        $place->fill($request->intersect([
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
        ]));

        if ($place->isClean()) {
            return $this->notUpdatedResponse('You need to specify different field to update!');
        }

        $rules = [
            'display_name'  => 'min:6', 
            'email'         => 'email',
            'photo'         => 'image'
        ]; 

        $this->validate($request, $rules);

        if ($request->photo) {
            $place->photo = $request->photo->store('');
        } 
        
        $place->save(); 

        return $this->showResponse($place);
    }

    public function destroy(Request $request,Place $place)
    {
        //
    }

    public function getPhoto(Request $request) 
    {
        $place = $this->place->findOrFail($request->id); 

        if (!Storage::exists($place->photo)) {
            return $this->notAcceptQueryResponse('Image not found!'); 
        }

        $file = Storage::get($place->photo);
        $type = Storage::mimeType($place->photo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    // MARK: - Function 

    public function getProductCategories(Request $request) 
    {
        $json = []; 
        $place = $this->place->findOrFail($request->id);

        $productCategories = $place->productCategories; 
        //return $this->listResponse($productCategories);

        foreach ($productCategories as $productCategory) {
            $item = $productCategory->products;  
            $item = [
                'category_name' => $productCategory->name, 
                'products'      => $productCategory->products
            ]; 
            array_push($json, $item); 
        }

        return $this->listResponse($json);
    }

    // Get around places 
    public function getAroundPlaces(Request $request) 
    {
        // Distance = sqrt( pow(latitude1 - longitude1) + pow(latitude2 - longitude2) )
        $places = $this->place->all(); 

        $aroundPlaces = []; 

        $latitude = $request->latitude; 
        $longitude = $request->longitude; 

        foreach ($places as $place) {
            if ($this->distance($latitude, $longitude, $place->latitude, $place->longitude) <= 10.0) {
                array_push($aroundPlaces, $place);
            }
        }

        return $this->listResponse($aroundPlaces);
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
    
    private function minutesCalculateForDistance($distance) 
    {
        // Assume the car drive in 40km/hour
        // Return time for minutes 
        return ($distance / 20) * 60; 
    }

    // Get all comments 
    public function getComments($id) 
    {
        $place = $this->place->findOrFail($id); 
        $comments = $place->comments; 

        return $this->listResponse($comments); 
    }

    // Get all orders 
    public function getAvailableOrders($id) {
        $place = $this->place->findOrFail($id); 
        $orders = $place->orders->where('status', Order::AVAILABLE); 
        return $this->listResponse($orders); 
    }

    public function getPendingOrders($id) {
        $place = $this->place->findOrFail($id); 
        $orders = $place->orders->where('status', Order::PENDING); 
        return $this->listResponse($orders); 
    }

    public function getRating($id) {
        $place = $this->place->findOrFail($id); 
        $comments = $place->comments; 

        $totalRating = 0; 
        $count = 0; 
        
        foreach ($comments as $comment) {
            $totalRating += $comment->rating;
            $count++; 
        }
        $result = $count == 0 ? 0 : $totalRating / $count; 

        return $this->showResponse([
            'rating' => $result
        ]);
    }

}
