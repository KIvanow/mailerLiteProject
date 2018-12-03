<?php

use Illuminate\Http\Request;
use App\Subscribers;
use App\Fields;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('subscribers', "SubscribersController@getAll");
Route::get('subscribers/{id}', "SubscribersController@get");
Route::get('subscribers/activate/{id}', "SubscribersController@activate");
Route::get('subscribers/unsubscribe/{id}', "SubscribersController@unsubscribe");
Route::get('subscribers/junk/{id}', "SubscribersController@junk");
Route::get('subscribers/unconfirm/{id}', "SubscribersController@unconfirm");
Route::get('subscribers/bounce/{id}', "SubscribersController@bounce");
Route::post('subscribers', "SubscribersController@create");
Route::put('subscribers/{id}', "SubscribersController@edit");
Route::delete('subscribers/{id}', "SubscribersController@destroy");

Route::get('fields/getSubscriberFields/{subscriber_id}', "FieldsController@getSubscriberFields");
Route::get('fields/{id}', "FieldsController@get");
Route::post('fields', "FieldsController@create");
Route::put('fields/{id}', "FieldsController@edit");
Route::delete('fields/{id}', "FieldsController@destroy");

Route::get('auth/logout', 'Auth\AuthController@logout');
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::get('user/{id}', "UsersController@get");
Route::get('users', "UsersController@getAll");
// Route::middleware('auth:api')
//     ->get('user/{id}', function (Request $request) {
//         var_dump( $request->user );
//         return $request->user();
//     });
