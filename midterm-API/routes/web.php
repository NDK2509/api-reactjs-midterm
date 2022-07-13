<?php

use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix("/admin")->group(function() {
    Route::resource("/foods", FoodController::class);
});
Route::prefix("/")->group(function() {
    Route::get("/", [HomeController::class, "index"])->name("home.index");
    Route::get("/home", [HomeController::class, "index"]);
    Route::get("/detail/{id}", [HomeController::class, "detail"])->name("home.detail");
});