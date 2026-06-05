<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

Route::get('/', [LogController::class, 'index']);
Route::get('/clear-logs', [LogController::class, 'clear']);
Route::get('/dashboard', [LogController::class, 'dashboard'])->name('logs.dashboard');
Route::get('/logs/export', [LogController::class, 'export'])->name('logs.export');
Route::post('/logs/cleanup', [LogController::class, 'cleanup'])->name('logs.cleanup');