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

Route::post('/user-store', [\App\Http\Controllers\API\UserAPIController::class,'store']);

Route::group([
    'middleware' => ['can:isAdmin'],
], function() {

    Route::delete('/user-delete/{user}', [\App\Http\Controllers\API\UserAPIController::class,'delete']);

});

Route::group([
    'middleware' => ['can:isUser'],
], function() {

    Route::get('/user-show/{user}', [\App\Http\Controllers\API\UserAPIController::class,'show']);

});

Route::put('/user-update/{user}', [\App\Http\Controllers\API\UserAPIController::class,'update'])->middleware('can:isManager')->name('user.update');
Route::get('/user-edit', 'UserAPIController@edit')->middleware('can:isAdmin')->name('user.edit');
