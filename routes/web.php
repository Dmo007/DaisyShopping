<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/item',App\Http\Controllers\ItemController::class);
Route::get('/item/categories/{id}',[App\Http\Controllers\ItemController::class,'itemCategory'])->name('itemcategory');
Route::get('/cart',[App\Http\Controllers\ItemController::class, 'cartTable'])->name('itemTable');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
