<?php

namespace App\Http\Controllers;

use App\User;
use App\Place; 
use App\PlaceCategoryDetail; 

use App\Http\Controllers\ApiController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiController
{   
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // MARK: - Database Methods 
    public function update(Request $request)
    {
        $user = $this->getAuthUser($request->token); 
        $user->fill($request->intersect([
            'display_name',
            'address', 
            'gender', 
            'email', 
            'phone_number',
            'photo'
        ]));

        if ($user->isClean()) {
            return $this->notUpdatedResponse('You need to specify different field to update!');
        }

        //
        $rule = [ 
            'photo' => 'image',
        ];


        if ($request->photo) {
            $this->validate($request, $rule);
            $user->photo = $request->photo->store('');
        }

        // Storing user 
        $user->save();

        // Show user which is stored
        return $this->showResponse($user);
    }
 
    public function getPhoto(Request $request) 
    {
        $user = $this->getAuthUser($request->token); 

        if (!Storage::exists($user->photo)) {
            return $this->notAcceptQueryResponse('Image not found!'); 
        }

        $file = Storage::get($user->photo);
        $type = Storage::mimeType($user->photo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    public function resetPassword(Request $request) 
    {
        $user = $this->getAuthUser($request->token); 
        $user->fill($request->intersect([
            'password'
        ]));

        if ($user->isClean()) {
            return $this->notUpdatedResponse('You has to type your new password!');
        }

        $rules = [
            'password' => 'required|min:6',
        ]; 

        $this->validate($request, $rules);

        $user->password = bcrypt($request->password); 
        // Update password
        $user->save();

        return $this->updatedResponse('Your password has changed!');
    }

    // MARK: - Authenticate Function  
    public function register(Request $request)
    {
        $rule = [
            'username' => 'required|min:6|unique:users',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rule); 

        $user = $this->user->create([
            'username' => $request->username, 
            'password' => bcrypt($request->password), 
            'display_name' => str_random(10), 
        ]); 

        return $this->createdResponse($user);
    }

    private function customRegister($username, $password) 
    {
        $user = $this->user->create([
            'username' => $username, 
            'password' => bcrypt($password), 
            'display_name' => str_random(10), 
        ]); 

        return $this->generateCredentials($username, $password);
    }
    
    public function login(Request $request) 
    {
        return $this->generateCredentials($request->username, $request->password);
    }

    public function socialLogin(Request $request) 
    {
        $rule = [
            'username' => 'required|min:6'
        ];

        $username = $request->username; 
        $password = $username; 

        $this->validate($request, $rule);

        $user = $this->user->where('username', '=', $username)->first();
        if ($user === null) { 
            return $this->customRegister($username, $password);
        } else { 
            return $this->generateCredentials($username, $password); 
        }
    }

    // MARK: - Authenticated Function 
    public function getProfile(Request $request)
    {
        $user = $this->getAuthUser($request->token); 
        return $this->showResponse($user); 
    }

    public function getPlaces(Request $request)
    {
        $user = $this->getAuthUser($request->token); 
        if ($user->role == $this->user->ROLE_OWNER) {
            $places = $user->places; 
            return $this->listResponse($places);
        }

        return $this->insufficientPrivilegesResponse('You just a user, please become a owner first!');
    }

    public function ownerRegister(Request $request) 
    {
        $rules = [
            'display_name'  => 'required', 
            'phone_number'  => 'required', 
            'address'       => 'required', 
            'photo'         => 'image', 
            'category_id'   => 'required' 
        ]; 

        $this->validate($request, $rules); 

        $user = $this->getAuthUser($request->token); 

        $photo = null; 
        if ($request->photo) {
            $photo = $request->photo->store(''); 
        }
        
        if ($user->role == User::ROLE_USER) {
            $user->status = User::OWNER_REGISTRATION; 
            $place = Place::create([
                'display_name'  => $request->display_name,
                'address'       => $request->address, 
                'phone_number'  => $request->phone_number,
                'photo'         => $photo,
                'status'        => Place::UNAVAILABLE, 
                'user_id'       => $user->id 
            ]);
            PlaceCategoryDetail::create([
                'place_id'      => $place->id, 
                'category_id'   => $request->category_id, 
            ]); 
            $user->save();
            return $this->showResponse('Owner registered! Please waiting for acception!');
        }

        return $this->insufficientPrivilegesResponse('You can\'t do this!');    
    }

    public function showRegistrationOwners(Request $request) 
    {
        $user = $this->getAuthUser($request->token); 
        if ($user->role == User::ROLE_ADMIN) {
            $owners = $this->user->where('status', User::OWNER_REGISTRATION)->get();
            return $this->listResponse($owners);
        }
        return $this->insufficientPrivilegesResponse('You dont have this permission!');
    }

    public function ownerAcception(Request $request) 
    {
        $rules = [
            'acception' => 'required',
            'user_id'   => 'required',
        ];

        $this->validate($request, $rules); 

        $user = $this->getAuthUser($request->token); 

        if ($user->role == User::ROLE_ADMIN) {
            $owner = $this->user->findOrFail($request->user_id);
            $place = Place::findOrFail($owner->places[0]->id); 
            $owner->status = User::AVAILABLE;  
            // 1 for accepted 
            if ($request->acception == 1) {
                $owner->role = User::ROLE_OWNER;
                $place->status = Place::AVAILABLE; 
                $place->save(); 
                $owner->save();
                return $this->showResponse('The request was accepted');
            } else {
                return $this->notUpdatedResponse('The request was denied');
            }  
        };
        return $this->insufficientPrivilegesResponse('You dont have this permission!'); 
    }

    // MARK: - Function 
}  