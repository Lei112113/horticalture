<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\NavController;

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


 
Route::resource('/', MainPageController::class);

Route::prefix('admin')->group(function () {
 
    Route::resource('contact', ContactController::class);
    Route::resource('nav', NavController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('/', AdminController::class);
});