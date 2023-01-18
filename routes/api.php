<?php

use App\Http\Controllers\LeadController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(LeadController::class)->group(function () {
    Route::get('/leads', 'index');
    Route::post('/leads', 'store');
    Route::get('/leads/{id}', 'show');
    Route::patch('/leads/{id}', 'update');
    Route::delete('/leads/{id}', 'destroy');
});