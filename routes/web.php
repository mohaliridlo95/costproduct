<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CostController;
use App\Http\Controllers\HomeController;


Route::get('/home', [HomeController::class, 'index']);
Route::get('/saran', [HomeController::class, 'saran']);

Route::get('/', [CostController::class, 'index']);
Route::post('/calculate', [CostController::class, 'calculate']);
Route::post('/download', [CostController::class, 'download']);
Route::get('/history', [CostController::class, 'showHistory']);
Route::post('/clear-history', [CostController::class, 'clearHistory']);

