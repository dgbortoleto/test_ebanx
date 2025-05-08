<?php

use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\EventController;

Route::get('/balance', [BalanceController::class, 'index']);
Route::post('/event', [EventController::class, 'store']);
