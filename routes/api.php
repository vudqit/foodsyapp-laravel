<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/register', 'UserController@register');

Route::post('auth/login', 'UserController@login');

Route::post('auth/login/social', 'UserController@socialLogin'); 

Route::group(['middleware' => 'jwt.auth'], function () {
    // User 
    Route::get('user/profile', 'UserController@getProfile');
	Route::post('user/update', 'UserController@update');
	Route::post('user/password', 'UserController@resetPassword');
	Route::get('user/photo', 'UserController@getPhoto');
	Route::get('user/places', 'UserController@getPlaces'); 
	Route::post('user/owner/register', 'UserController@ownerRegister'); 
	Route::get('user/admin/owner', 'UserController@showRegistrationOwners');
	Route::post('user/admin/acception', 'UserController@ownerAcception');

    // PLACE 
	Route::get('place', 'PlaceController@getPlaces');
	Route::post('place/store', 'PlaceController@store');
	Route::post('place/update', 'PlaceController@update');
	Route::get('place/photo', 'PlaceController@getPhoto');
	Route::get('place/menu', 'PlaceController@getProductCategories');
	Route::get('place/around', 'PlaceController@getAroundPlaces');
	Route::get('place/{id}', 'PlaceController@getPlace');
	Route::get('place/{id}/comments', 'PlaceController@getComments');
	Route::get('place/{id}/orders/available', 'PlaceController@getAvailableOrders');
	Route::get('place/{id}/orders/pending', 'PlaceController@getPendingOrders');
	Route::get('place/rating/{id}', 'PlaceController@getRating');
	
	// PLACE CATEGORY 
	Route::get('category/place', 'PlaceCategoryController@getAll');
	Route::get('place/category/{name}', 'PlaceCategoryController@getPlaces');
	
	// PLACE CATEGORY DETAIL

	// PRODUCT 
	Route::get('product', 'ProductController@getAll'); 
	Route::post('product/store', 'ProductController@store');
	Route::post('product/update', 'ProductController@update');
	Route::get('product/{id}/photo', 'ProductController@getPhoto');

	// PRODUCT CATEGORY 
	Route::get('category/product', 'ProductCategoryController@getAll'); 
	Route::post('category/product/store', 'ProductCategoryController@store');

	// ORDER 
	Route::get('order', 'OrderController@getAll');
	Route::post('order/store', 'OrderController@store'); 
	Route::get('order/{id}/details', 'OrderController@getOrderDetails');

	// ORDER DETAIL
	Route::post('order/detail/store', 'OrderDetailController@store');
	Route::get('order/detail/{id}/product', 'OrderDetailController@getProduct');
	Route::post('order/detail/{id}/done', 'OrderDetailController@done');

	// COMMENT
	Route::post('comment/store', 'CommentController@store');
	Route::get('comment/{id}/photo', 'CommentController@getPhoto');

	// EVENT 
	Route::get('event/available', 'EventController@getAvailableEvents');
	Route::get('event/pending', 'EventController@getPendingEvents');
	Route::post('event/store', 'EventController@store');
	Route::post('event/update', 'EventController@update');
	Route::get('event/{id}/photo', 'EventController@getPhoto');
});
