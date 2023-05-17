<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

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
 
    Route::resource('/', AdminController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('nav', NavController::class);
});