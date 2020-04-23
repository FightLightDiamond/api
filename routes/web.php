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

//    const url = 'http://cuongpm.tk:8002'
//  const ck = 'ck_752b8da883ed65df1faa38106d80ee38cfd87eb5'
//  const cs = 'cs_9c207d00c8606d755408816d9285b41add33304a'

    $url = 'http://cuongpm.tk:8002';
    $consumer_key = 'ck_752b8da883ed65df1faa38106d80ee38cfd87eb5';
    $consumer_secret = 'cs_9c207d00c8606d755408816d9285b41add33304a';
    $options = [
        'version' => 'wc/v3',
    ];

    $woocommerce = new \Automattic\WooCommerce\Client($url, $consumer_key, $consumer_secret, $options);

    $data = [
        'name' => 'Premium Quality',
        'type' => 'simple',
        'regular_price' => '21.99',
        'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
        'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
        'categories' => [
            [
                'id' => 9
            ],
            [
                'id' => 14
            ]
        ],
        'images' => [
            [
                'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
            ],
            [
                'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
            ]
        ]
    ];

    dd($woocommerce->post('products', $data));
    dd($woocommerce->get('products'));
});
