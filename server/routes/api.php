<?php
use App\Http\Controllers\SalesController;

Route::post('sales',[SalesController::class, 'store']);
Route::get('get-batch-details/{id}',[SalesController::class, 'batch']);
Route::get('get-batch-progress',[SalesController::class, 'batchInProgress']);
