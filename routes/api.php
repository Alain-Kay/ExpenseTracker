<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/income', [IncomeController::class, 'getIncomes']);
Route::post('/income/store', [IncomeController::class, 'createNewIncome']);
Route::put('/income/update/{id}', [IncomeController::class, 'updateIncome']);
Route::delete('/income/delete/{id}', [IncomeController::class, 'deleteIncome']);
Route::get('/expense', [ExpenseController::class, 'getExpenses']);
Route::post('/expense/store', [ExpenseController::class, 'createNewExpense']);
Route::put('/expense/update/{id}', [ExpenseController::class, 'updateExpense']);
Route::delete('/expense/delete/{id}', [ExpenseController::class, 'deleteExpense']);