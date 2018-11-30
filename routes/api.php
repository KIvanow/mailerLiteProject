<?php

use Illuminate\Http\Request;
use App\Subscribers;

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


Route::get('/subscribers', "SubscribersController@getAll");
Route::get('subscribers/{id}', "SubscribersController@get");

Route::post('subscribers', "SubscribersController@create");

Route::put('subscribers/{id}', "SubscribersController@edit");

Route::delete('subscribers/{id}', "SubscribersController@destroy");
