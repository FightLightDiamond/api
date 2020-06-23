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

Route::get('woocommerce', function () {
    $url = 'http://cuongpm.tk:8002';
    $consumer_key = 'ck_752b8da883ed65df1faa38106d80ee38cfd87eb5';
    $consumer_secret = 'cs_9c207d00c8606d755408816d9285b41add33304a';
    $options = [
        'version' => 'wc/v3',
    ];

    $woocommerce = new \Automattic\WooCommerce\Client($url, $consumer_key, $consumer_secret, $options);

//    try {
    $parameters = array(
        'order' => 'asc',
        'orderby' => 'id',
        'after' => '2020-04-21T00:43:48',
        'before' => '2020-05-12T00:43:48',
        'per_page' => '2',
        'page' => '2',
        'status' => 'processing',
        'search' => 'Thompson',
        'product' => '20',
    );

    $res = $woocommerce->get('orders', $parameters);
    $res = $woocommerce->get('shipping/zones', $parameters);

    $email = rand(1, 99999) . 'email@g.vn';
    $firstName = \Illuminate\Support\Str::random(16);
    $lastName = \Illuminate\Support\Str::random(16);

    $newCustomers = [
        'email' => $email,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'username' => '',
        'billing' => [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'company' => '1',
            'address_1' => '1',
            'address_2' => '1',
            'city' => '1',
            'state' => '1',
            'postcode' => '1',
            'country' => '1',
            'email' => $email,
            'phone' => '1'
        ],
        'shipping' => [
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'company' => '1',
            'address_1' => '1',
            'address_2' => '1',
            'city' => '1',
            'state' => '1',
            'postcode' => '1',
            'country' => '1',
        ]
    ];

    $res = $woocommerce->post('customers', $newCustomers);

    $req = $lastRequest = $woocommerce->http->getRequest();
    $url = $lastRequest->getUrl();
    $method = $lastRequest->getMethod();
    $reqParameters = $lastRequest->getParameters();
    $reqHeaders = $lastRequest->getHeaders();
    $reqBody = $lastRequest->getBody();

    $lastResponse = $woocommerce->http->getResponse();
    $code = $lastResponse->getCode();
    $resHeader = $lastResponse->getHeaders();
    $resBody = $lastResponse->getBody();

    dump(compact('req', 'url', 'method', 'reqParameters', 'reqHeaders', 'reqBody'));
    dump(compact('code', 'resHeader', 'resBody'));
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

Route::get('avatar', function () {
    $client = new \GuzzleHttp\Client();

    $result = $client->post('http://54.254.196.156/api/user/update_avatar/?insecure=cool', [
        'multipart' => [
            [
                'name' => 'token',
                'contents' => 'update|1590646367|SHt5VoEzNaMOstBLuhck6AJ7QZV6f4z0hKmHHp9ge7d|610703edb11e543d021bab5a71b15c61d7a16b4ae20484d03e018a98a5c8989c'
            ],
            [
                'name' => 'image',
                'contents' => fopen(__DIR__ . '/Screen Shot 2020-05-11 at 13.53.36.png', 'r')
            ]
        ]
    ]);

    $body = $result->getBody();

    dump($body->getContents());
});


