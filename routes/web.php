<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dl', function () {
    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\WPExport(), 'product.csv');
});

Route::get('vnp', function () {
    return view('vnp');
});

Route::post('vnp', function () {
    $vnp_TmnCode = "Q1LUB9ZD"; //Mã website tại VNPAY
    $hashSecret = "LNXVGGSETITORLSGEXOBVWSZLZLKDTGS"; //Chuỗi bí mật
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = url("api/vnpay_return");
    $vnp_Locale = 'vn';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $vnp_OrderInfo = request('vnp_OrderType', 1100);
    $vnp_OrderType = request('vnp_OrderType', 1100);
    $vnp_Amount = request('vnp_Amount', 10000000);
    //$vnp_Amount = 10000000;


    $inputData = array(
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => rand(111111, 9999999),
        "vnp_Version" => "2.0.0",
    );
    ksort($inputData);

    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . $key . "=" . $value;
        } else {
            $hashdata .= $key . "=" . $value;
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $vnp_Url = $vnp_Url . "?" . $query;

    if (isset($hashSecret)) {
//        $vnpSecureHash = md5($hashSecret . $hashdata);
//        $vnp_Url .= 'vnp_SecureHashType=MD5&vnp_SecureHash=' . $vnpSecureHash;

        $vnpSecureHash = hash('sha256', $hashSecret . $hashdata);
        $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;

        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);

        return response()->json($returnData);
    }
});






