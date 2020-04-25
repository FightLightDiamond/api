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
    $parameters =  array(
        'order'=>'asc',
        'orderby' =>'id',
        'after' =>'2020-04-21T00:43:48',
        'before' =>'2020-05-12T00:43:48',
        'per_page' =>'2',
        'page' =>'2',
        'status' =>'processing',
        'search' =>'Thompson',
        'product' =>'20',
    );

    $res = $woocommerce->get('orders', $parameters);
    $res = $woocommerce->get('shipping/zones', $parameters);
//    $res = $woocommerce->get('shipping_methods', $parameters);

    dd($res);

//    $raw_data = fopen(public_path('MOCK_DATA.csv'), 'r');

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
dd($res);
//        return response()->json($res);
//    } catch (\Automattic\WooCommerce\HttpClient\HttpClientException $exception) {
//        $exception->getMessage();
//        $exception->getRequest();
//        $exception->getResponse();
//    }
});
