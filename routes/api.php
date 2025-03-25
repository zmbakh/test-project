<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('auth/sign-in', [AuthController::class, 'signIn']);
