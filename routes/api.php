<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)->except('show');

Route::post('notifyapp', [NotificationController::class, 'notifyapp']);