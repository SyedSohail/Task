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

Route::post('admin/signup','AdminController@signup');
Route::post('admin/login','AdminController@login');

Route::post('user/signup','UserController@signup');
Route::post('/user/login','UserController@login');

Route::post('bloger/signup','BlogerController@signup');
Route::post('bloger/login','BlogerController@login');

// Route::group(['middleware' => ['auth:api'],'prefix' => 'admin'], function () {

// 	Route::resource('blog','AdminController');

// 	});

// Route::group(['middleware' => ['auth:api'],'prefix' => 'user'], function () {


// 	});

Route::group(['middleware' => ['auth:api'],'prefix' => 'bloger'], function () {

	Route::resource('blog','BlogerController');


	});

