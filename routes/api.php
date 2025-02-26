<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiVersion(1)->group(function() {
//    Route::apiResource("lecturers", [UserController::class, "index"]);
//});
