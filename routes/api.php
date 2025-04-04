<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get(uri: '/user', action: function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post(uri: '/login', action: [AuthController::class, 'login']);