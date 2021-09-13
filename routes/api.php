<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

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
    'middleware' => 'api'
], function ($router) {
    //wallets routes
    Route::get('getwallets', [WalletController::class, 'index']);
    Route::get('wallet/{id}', [WalletController::class, 'show']);
    Route::post('/transfer_fund', [WalletController::class, 'transferMoney']);

    //users routes
    Route::get('getusers', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);

    Route::get('get_total', [UserController::class, 'getCount']);

});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, admim@admin.com'], 404);
});
