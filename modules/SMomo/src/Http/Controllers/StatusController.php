<?php


namespace SMOMO\Http\Controllers;


use MService\Payment\Shared\SharedModels\Environment;
use MService\Payment\Shared\SharedModels\PartnerInfo;

class StatusController
{
    public function index() {
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
    }
}
