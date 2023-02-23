<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

// CRUD Users
Route::post('/create', [ApiController::class, 'create']);
Route::post('/update',  [ApiController::class, 'update']);
Route::post('/delete',  [ApiController::class, 'delete']);

Route::post('/list',  [ApiController::class, 'list']);
Route::post('/listAll',  [ApiController::class, 'listAll']);

