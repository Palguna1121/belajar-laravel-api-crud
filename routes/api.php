<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/update/{id}', [UserController::class, 'update']);
Route::post('users/create', [UserController::class, 'store']);
Route::delete('users/delete/{id}', [UserController::class, 'destroy']);
