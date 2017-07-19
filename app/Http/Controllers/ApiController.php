<?php

namespace App\Http\Controllers;

use App\User;

use JWTAuth;
use JWTAuthException;
use App\Traits\ApiResponser;

class ApiController extends Controller
{
    use ApiResponser; 

    public function checkUserHasOwnerPermission($token) {
        $user = JWTAuth::toUser($token); 
        if ($user->role == User::ROLE_USER) {
            return $this->insufficientPrivilegesResponse('You just a user, please subscribe to owner to create your own places');
        }
    }

    public function getAuthUser($token) {
        return JWTAuth::toUser($token);
    }

    public function generateCredentials($username, $password) {
        $credentials = [
            'username' => $username, 
            'password' => $password
        ];
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return $this->validationErrorResponse('Invalid username or password');
           }
        } catch (JWTAuthException $e) {
            return $this->errorResponse('Failed to create token');
        }
        return $this->showResponse(compact('token'));
    }

}
