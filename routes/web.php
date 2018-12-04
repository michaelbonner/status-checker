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
	return view('enter-urls');
});

Route::post('/check-urls', 'PageController@check_urls' );

Route::post('check_status', 'HttpStatusChecker@check_status' );
Route::get('check_status/{url}', 'HttpStatusChecker@check_status' );
