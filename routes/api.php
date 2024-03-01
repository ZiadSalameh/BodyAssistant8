<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\Controller;


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
// 
Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);
// 
//Route::get('/get-data','getData');

Route::middleware('auth:api')->group(function () {
    Route::resource('personal_information', 'API\PersonalInformationController');
    Route::resource('diseases', 'API\DiseaseController');
    Route::resource('exercises', 'API\ExerciseController');
    Route::resource('meals', 'API\mealsController');
    Route::resource('recommended_meals', 'API\recommendedmealsController');
});
