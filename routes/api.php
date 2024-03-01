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

//authentecation routes...
Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
Route::get('/logout',[App\Http\Controllers\UserController::class,'logout']);

//restaurants routes....

//1-view all restaurants
Route::get('/view/restaurants',[App\Http\Controllers\RestaurantController::class,'index'])->middleware('auth:sanctum');
//2-view one restaurant 
Route::get('/view/one/restaurant/{uuid}',[App\Http\Controllers\RestaurantController::class,'show'])->middleware('auth:sanctum');
//3-search  restaurants by location and cusine type
Route::post('/search/restaurant',[App\Http\Controllers\RestaurantController::class,'search'])->middleware('auth:sanctum');

//orders routes....

//1-view all orders...
//Route::get('/view/orders',[App\Http\Controllers\OrderController::class,'index'])->middleware('auth:sanctum');
//2-view user history orders..
Route::get('/view/user/orders',[App\Http\Controllers\UserController::class,'historyOrder'])->middleware('auth:sanctum');
//3-add an  order order...
Route::post('/add/order/{uuid}',[App\Http\Controllers\OrderController::class,'create'])->middleware('auth:sanctum');

Route::post('/edit/order/{uuid}',[App\Http\Controllers\OrderController::class,'update'])->middleware('auth:sanctum');
//4- view specefic order
Route::get('/view/order/{uuid}',[App\Http\Controllers\OrderController::class,'show'])->middleware('auth:sanctum');


//reviews routes....

//1-new review
Route::post('/add/review/{uuid}',[App\Http\Controllers\ReviewController::class,'create'])->middleware('auth:sanctum');
//2-delete review..
Route::get('/remove/review/{uuid}',[App\Http\Controllers\ReviewController::class,'delete'])->middleware('auth:sanctum');
//3=edite review..
Route::post('/edit/review/{uuid}',[App\Http\Controllers\ReviewController::class,'update'])->middleware('auth:sanctum');