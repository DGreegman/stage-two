<?php

use App\Http\Controllers\Api\PersonController;
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

// to check all the users
Route::get('/person', [PersonController::class, 'index']);

// to create a person
Route::post('/', [PersonController::class, 'store']);

// to read a person
Route::get('/{user_id}', [PersonController::class, 'show']);

// To update a person
Route::put('/{user_id}', [PersonController::class, 'update']);

// To delete a person
Route::delete('/{user_id}', [PersonController::class, 'destroy']);
