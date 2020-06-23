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

Route::get('pay-atm', function () {
    $momoEndpoit = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    $accessKey = "mcySd1lRah6sKeLV";
    $partnerCode = 'MOMOSWGM20200616';
    $secretKey = 'eiuSd1u5ijiiNdIpKQgCGuYSgiSYXBm4';
    $target = 'development';
    $requestId = time() . "";
    $notifyUrl = \route('momo_ipn');
    $returnUrl = \route('momo_ipn');

    $env = new Environment($momoEndpoit, new PartnerInfo($accessKey, $partnerCode, $secretKey), $target);

    $orderId = (string)request('orderId');
    $orderInfo = request('orderInfo');;
    $amount = request('amount');
    $bankCode = request('bankCode');

    $extraData = "";

    $res = PayATM::process($env, $orderId, $orderInfo, $amount,
        $extraData, $requestId, $notifyUrl, $returnUrl, $bankCode);
    if ($res->getPayUrl()) {
        return response()->json([
            'url' => $res->getPayUrl(),
            'qr' => $res->getQrCodeUrl(),
        ]);
    }

    return response()->json([
        'message' => $res->getMessage(),
        'local_message' => $res->getLocalMessage(),
    ], 422);
});

Route::get('qr-mm', function () {
    $momoEndpoit = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    $accessKey = "mcySd1lRah6sKeLV";
    $partnerCode = 'MOMOSWGM20200616';
    $secretKey = 'eiuSd1u5ijiiNdIpKQgCGuYSgiSYXBm4';
    $target = 'development';
    $requestId = time() . "";
    $notifyUrl = \route('momo_ipn');
    $returnUrl = \route('momo_ipn');

    $env = new Environment($momoEndpoit,
        new PartnerInfo($accessKey, $partnerCode, $secretKey), $target);

//    $orderId = (string)request('orderId');
    $orderId = time() . "";
    $orderInfo = request('orderInfo');;
    $amount = request('amount');

    $extraData = "";

    $response = CaptureMoMo::process($env, $orderId, $orderInfo,
        $amount, $extraData, $requestId, $notifyUrl, $returnUrl);

//   return redirect($response->getPayUrl());
    dump($response);
    dump($response->getDeeplinkWebInApp());
    dd($response->getPayUrl());
    return redirect($response->getDeeplinkWebInApp());
});

Route::get('momo_ipn', function () {
    return response(\request()->all());
})->name('momo_ipn');

Route::get('momo-status', function () {
    $momoEndpoit = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    $accessKey = "mcySd1lRah6sKeLV";
    $partnerCode = 'MOMOSWGM20200616';
    $secretKey = 'eiuSd1u5ijiiNdIpKQgCGuYSgiSYXBm4';
    $target = 'development';
    $requestId = time() . "";
    $notifyUrl = \route('momo_ipn');
    $returnUrl = \route('momo_ipn');

    $env = new Environment($momoEndpoit,
        new PartnerInfo($accessKey, $partnerCode, $secretKey), $target);

    $responseList = RefundStatus::process($env, '1561972963', '1561972963');

    dd($responseList);

})->name('momo.status');

Route::get('app-pay', function () {
    $momoEndpoit = "https://test-payment.momo.vn/pay/app";
    $accessKey = "mcySd1lRah6sKeLV";
    $partnerCode = 'MOMOSWGM20200616';
    $secretKey = 'eiuSd1u5ijiiNdIpKQgCGuYSgiSYXBm4';
    $target = 'development';

    $amount = 200000;
    $appData = 'ORDER_ID';

    $publicKey = '';

    $customerNumber = "0359003851";
    $partnerRefId = "MA_DON_HANG";
    $env = new Environment($momoEndpoit,
        new PartnerInfo($accessKey, $partnerCode, $secretKey), $target);

    $res = \MService\Payment\Pay\Processors\AppPay::process($env,
        $amount,
        $appData,
        $publicKey,
        $customerNumber,
        $partnerRefId,
        $version = 2.0,
        $payType = 3,
        $description = '',
        $partnerName = '',
        $partnerTransId = '',
        $storeId = '',
        $storeName = '');

    dd($res);
});
