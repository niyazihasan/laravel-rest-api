<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\IncomeCategoryController;
use App\Http\Controllers\Api\TransactionController;

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

Route::get('/', function() {
    return view('api');
});

Route::apiResource('accounts', AccountController::class);
Route::apiResource('expense-categories', ExpenseCategoryController::class);
Route::apiResource('income-categories', IncomeCategoryController::class);
Route::apiResource('transactions', TransactionController::class);
