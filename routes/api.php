<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\StatusKepController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TrackTernakController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('check-auth', [App\Http\Controllers\Auth\LoginController::class, 'checkAuth'])->name('logout');

Route::get('biodata/{id}', [BiodataController::class, 'index']);
Route::post('biodata', [BiodataController::class, 'store']);
Route::post('biodata/updated', [BiodataController::class, 'update']);

Route::get('skala/{id}', [StatusKepController::class, 'index']);
Route::post('skala', [StatusKepController::class, 'store']);
Route::post('skala/updated', [StatusKepController::class, 'update']);

Route::get('location/{id}', [LocationController::class, 'index']);
Route::post('location', [LocationController::class, 'store']);
Route::post('location/updated', [LocationController::class, 'update']);

Route::post('getTernak', [TrackTernakController::class, 'index']);
Route::post('getHistory', [TrackTernakController::class, 'history']);
Route::post('trackternak', [TrackTernakController::class, 'store']);
// Route::post('trackternak/updated', [TrackTernakController::class, 'update']);


Route::get('getuser', [AdminController::class, 'user']);