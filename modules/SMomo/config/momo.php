<?php

return [
    'endpoint' => env('MOMO_ENDPOINT', "https://test-payment.momo.vn/gw_payment/transactionProcessor"),
    'access-key' => env('MOMO_ACCESS_KEY', 'mcySd1lRah6sKeLV'),
    'partner-code' => env('MOMO_PARTNER_CODE', 'MOMOSWGM20200616'),
    'secret-key' => env('MOMO_SECRET_KEY', 'eiuSd1u5ijiiNdIpKQgCGuYSgiSYXBm4'),
    'target' => env('MOMO_TARGET', 'development')
];
