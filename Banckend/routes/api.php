<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\Controller;

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

// EMPLOYEE API ROUTES
Route::get('/employees', [EmployeeApiController::class, 'index']);
Route::get('new', [EmployeeApiController::class, 'New']);
Route::post('/employees/store', [EmployeeApiController::class, 'store']);
Route::post('/employees/update', [EmployeeApiController::class, 'update']);
Route::post('/employees/delete', [EmployeeApiController::class, 'delete']);


// PRODUCT API ROUTES
Route::get('/products', [ProductApiController::class, 'index']);
Route::post('/products/store', [ProductApiController::class, 'store']);
Route::post('/products/update', [ProductApiController::class, 'update']);
Route::post('/products/delete', [ProductApiController::class, 'delete']);

