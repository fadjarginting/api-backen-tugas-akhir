<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MateriController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
//get user by id
Route::get('user/{id}', [UserController::class, 'getuser']);
Route::get('materi', [MateriController::class, 'getmateri']);
Route::post('post-materi', [MateriController::class, 'postmateri']);
