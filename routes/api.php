<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DepartmentController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
     Route::get('user', 'UserController@getAuthenticatedUser');
     Route::get('logout', 'UserController@logout');
     //------------------------------------------
     Route::get('userdepartment', 'DepartmentController@userdepartment');
     Route::get('departments', 'DepartmentController@index');
     Route::get('departments/{id}', 'DepartmentController@show');
     Route::post('departments', 'DepartmentController@store');
     Route::put('departments/{id}', 'DepartmentController@update');
     Route::delete('departments/{id}', 'DepartmentController@destroy');
});
