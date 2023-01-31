<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\DeliveryController;

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
Route::prefix('delivery')->group(function () {

    Route::post('/send', [DeliveryController::class, 'send'])->name('delivery.send');

    Route::get('/status', [DeliveryController::class, 'getStatus'])->name('delivery.get_status');

});
