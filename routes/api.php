<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get-all-products',  [ProductsController::class , 'getallproducts']);
Route::post('/get-product-byid',  [ProductsController::class , 'getproductbyid']);
Route::post('/get-my-products',  [ProductsController::class , 'getmyproduucts']);





Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('/login', [AuthController::class , 'login']);
    Route::post('/register', [AuthController::class , 'register']);
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::post('/refresh', [AuthController::class , 'refresh']);
    Route::post('/me', [AuthController::class , 'me']);
    Route::post('/store',  [ProductsController::class , 'store']);

});
