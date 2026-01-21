<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObjetController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/objets', [ObjetController::class, 'index']);
Route::get('/objets/{id}', [ObjetController::class, 'show']);
Route::get('/objets/filter', [ObjetController::class, 'filter']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/objets', [ObjetController::class, 'store']);
    Route::put('/objets/{id}', [ObjetController::class, 'update']);
    Route::delete('/objets/{id}', [ObjetController::class, 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/my-objets', [ObjetController::class, 'myObjects']);
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/test', function () {
            return response()->json(['message' => 'Bienvenue Admin']);
        });
    });
});