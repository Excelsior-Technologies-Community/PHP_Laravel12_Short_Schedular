<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

Route::get('/', [LogController::class, 'index']);
Route::get('/clear-logs', [LogController::class, 'clear']);