<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\v1\GenderController;
use App\Http\Controllers\v1\LevelController;
use App\Http\Controllers\v1\StatusController;
use App\Http\Controllers\v1\StudentController;
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
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('check', [AuthController::class, 'check']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::post('student-register', [StudentController::class, 'register']);
    Route::get('status', [StatusController::class, 'allStatus']);
    Route::get('gender', [GenderController::class, 'allGender']);
    Route::get('level', [LevelController::class, 'allLevel']);

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('users', [AuthController::class, 'allUser']);
        Route::post('get-user', [AuthController::class, 'getUser']);
    });
});
