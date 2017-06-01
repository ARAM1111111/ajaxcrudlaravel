<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>['web']],function(){
	Route::resource('blog','BlogController');
});

Route::group(['middleware'=>['web']],function(){
	Route::resource('blog2','Blog2Controller');
	Route::post('/editItem','Blog2Controller@editItem');
	Route::post('/addItem','Blog2Controller@addItem');
	Route::post('/delItem','Blog2Controller@delItem');
});
