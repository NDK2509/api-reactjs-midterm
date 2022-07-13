<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiFoodController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("/foods")->group(function(){
    Route::get("/search", [ApiFoodController::class, "search"]);
    Route::get("", [ApiFoodController::class,"all"]);
    Route::get("/{id}", [ApiFoodController::class,"get"]);
    Route::post("", [ApiFoodController::class, "create"]);
    Route::put("/{id}", [ApiFoodController::class, "update"]);
    Route::delete("/{id}", [ApiFoodController::class, "delete"]);
});
Route::prefix("/categories")->group(function(){
    Route::get("", [ApiCategoryController::class,"all"]);
    Route::get("/{id}", [ApiCategoryController::class,"get"]);
});