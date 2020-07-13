<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MService\Payment\AllInOne\Processors\CaptureIPN;
use MService\Payment\AllInOne\Processors\CaptureMoMo;
use MService\Payment\AllInOne\Processors\PayATM;
use MService\Payment\AllInOne\Processors\RefundStatus;
use MService\Payment\Shared\SharedModels\Environment;
use MService\Payment\Shared\SharedModels\PartnerInfo;

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

Route::get('/vnpay_return', function () {
    logger(request()->all());
    logger(url('vnpay_return'));
    return request()->all();
});
