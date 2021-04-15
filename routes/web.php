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

use App\Http\Controllers\HttpStatusChecker;
use App\Http\Controllers\PageController;

Route::get('/', function () {
	return view('enter-urls');
});

Route::post('/check-urls', [
	PageController::class,
	'check_urls'
]);

Route::post('check_status', [
	HttpStatusChecker::class,
	'check_status'
]);
Route::get(
	'check_status/{url}',
	[
		HttpStatusChecker::class,
		'check_status'
	]
);
