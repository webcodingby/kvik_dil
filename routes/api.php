<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTaskController;
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
Route::apiResource('tasks', ApiTaskController::class);
Route::get('tasks/search', [ApiTaskController::class, 'search']);
// Additional routes for soft deletion
Route::post('tasks/{id}/restore', [ApiTaskController::class, 'restore']);
Route::delete('tasks/{id}/force', [ApiTaskController::class, 'forceDelete']);
Route::get('search', [ApiTaskController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
