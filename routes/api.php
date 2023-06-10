<?php

/*use Illuminate\Http\Request;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
});


Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'v1'
], function ($router) {
    Route::get('/candidate/{id}', [CandidateController::class, 'show']);
    Route::post('/candidates', [CandidateController::class, 'store']);
    Route::get('/candidates', [CandidateController::class, 'list']);
    Route::get('/candidate/search/{keyword}', [CandidateController::class, 'search']);
});


// Route::group(['middleware' => 'jwt.verify', 'prefix' => 'v1'], function() {
//     // Route::get('logout', [ApiController::class, 'logout']);
//     // Route::get('get_user', [ApiController::class, 'get_user']);
//     Route::post('/candidates', [CandidateController::class, 'store']);
//     // Route::get('products/{id}', [ProductController::class, 'show']);
//     // Route::post('create', [ProductController::class, 'store']);
//     // Route::put('update/{product}',  [ProductController::class, 'update']);
//     // Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
// });