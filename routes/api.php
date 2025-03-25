<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Transactions\TransactionController;
use App\Http\Controllers\Transactions\UserBalanceController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/sign-in', [AuthController::class, 'signIn']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'profile']);
    Route::get('balance', [UserBalanceController::class, 'balance']);
    Route::get('transactions', [TransactionController::class, 'index']);
});
