<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/income', [IncomeController::class, 'index']);
Route::post('/income/store', [IncomeController::class, 'store']);
Route::put('/income/update/{id}', [IncomeController::class, 'update']);
Route::delete('/income/delete/{id}', [IncomeController::class, 'delete']);
