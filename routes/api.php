<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//list
Route::get('item/list',[App\Http\Controllers\API\RouteController::class,'itemList']);
Route::get('categories/list',[App\Http\Controllers\API\RouteController::class,'categoryList']);
//create
Route::post('create/categroy',[App\Http\Controllers\API\RouteController::class,'createCategroy']);
Route::post('create/item',[App\Http\Controllers\API\RouteController::class,'createItem']);
//delete
Route::post('delete/item',[App\Http\Controllers\API\RouteController::class,'deleteItem']);
Route::get('delete/item/{id}',[App\Http\Controllers\API\RouteController::class,'deleteItemGet']);
Route::get('delete/category/{id}',[App\Http\Controllers\API\RouteController::class,'deleteCategoryGet']);


