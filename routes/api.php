<?php

use App\Http\Controllers\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', V1\CustomerController::class);
    Route::apiResource('invoices', V1\InvoiceController::class);

    Route::post('invoices/bulk', [V1\InvoiceController::class, 'storeBulk']);
    Route::get('ping', V1\PingController::class);
});

