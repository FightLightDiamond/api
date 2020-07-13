<?php

Route::name('api.')
    ->namespace('SMOMO\Http\Controllers')
    ->prefix('api/smomo')
    ->middleware(['api', 'cors'])
    ->group(function () {
        Route::get('pay-atm', 'PayATMController@index')->name('momo.pay-atm');
        Route::get('qr', 'QrController@index')->name('momo.qr');
        Route::get('ipn', 'INPController@index')->name('momo.ipn');
        Route::get('status', 'StatusController@index')->name('momo.status');
        Route::get('app-pay', 'AppPayController@index')->name('momo.app-pay');
    });


function encryption($data, $encryption_key, $iv)
{
//    $iv = 'iH84aMMOeP8CJ+wn';
    return openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function decryption($encrypted, $encryption_key, $iv)
{
//    $iv = 'iH84aMMOeP8CJ+wn';
//    $iv = \Illuminate\Support\Str::random(16);
//    dd(strlen($iv));
    $encrypted = $encrypted . ':' . base64_encode($iv);
    $parts = explode(':', $encrypted);

    return openssl_decrypt($parts[0], 'aes-256-cbc', $encryption_key, 0, base64_decode($parts[1]));
}

Route::get('aes', function () {
    $sValue = "123454fsjfhs sjgjhfs fsgfsjf fsjfgs";
    $sSecretKey = 43535;

    $iv = \Illuminate\Support\Str::random(16);

    $res = encryption($sValue, $sSecretKey, $iv);

    $en = decryption($res, $sSecretKey, $iv);

    dump($res, $en);
});
