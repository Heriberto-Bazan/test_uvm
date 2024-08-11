<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('users', [AuthController::class, 'index']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('transaction-register', [TransactionController::class, 'register']);
        Route::get('transaction-all', [TransactionController::class, 'index']);
        Route::get('transaction-code/{code}', [TransactionController::class, 'code']);
        Route::get('transaction-id/{id}', [TransactionController::class, 'show']);
        Route::put('transaction-provider/{id}', [AuthController::class, 'update']); 
    
    });
});
