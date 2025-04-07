<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomainItemController;
use App\Http\Controllers\TaskController;

Route::get(uri: '/user', action: function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post(uri: '/login', action: [AuthController::class, 'login']);

Route::get(uri: '/my-tasks', action: [TaskController::class, 'myTasks'])
    ->middleware('auth:sanctum');

Route::get(uri: '/get-items/{domain}', action: [DomainItemController::class, 'getByDomain'])
    ->middleware('auth:sanctum');