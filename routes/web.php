<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    echo'<pre>';
    var_dump($query->sql);
    var_dump($query->bindings);
    var_dump($query->time);
    echo'</pre>';
}); */

// Route::resource('/subscribers', 'SubscribersController');
Route::resource('/fields', 'FieldsController');
Route::resource('/sample', 'SampleVisualizationController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
