<?php


namespace SMOMO\Http\Controllers;


use Illuminate\Support\Facades\Http;
use MService\Payment\AllInOne\Processors\CaptureMoMo;

class QrController extends AbstractSMOMOController
{
    public function index()
    {
//        $this->setEndpoint(config('momo.endpoint'));

        $requestId = time() . "";
        $orderId = time() . "";
        $orderInfo = request('orderInfo');;
        $amount = request('amount');
        $extraData = "";

//        return $this->getQr($requestId, $orderId, $amount, $orderInfo, $extraData);

        $response = CaptureMoMo::process($this->getEnv(), $orderId, $orderInfo,
            $amount, $extraData, $requestId, $this->getNotifyUrl(), $this->getReturnUrl());

        return redirect($response->getDeeplinkWebInApp());
    }

    public function getQr($requestId, $orderId, $amount, $orderInfo, $extraData)
    {
        $string="partnerCode={$this->getPartnerCode()}&accessKey={$this->getAccessKey()}&requestId=$requestId&amount=50000&orderId=$orderId&orderInfo=$orderInfo&returnUrl={$this->getReturnUrl()}&notifyUrl={$this->getNotifyUrl()}&extraData=$extraData";

        $data = [
            'partnerCode' => $this->getPartnerCode(),
            'accessKey' => $this->getAccessKey(),
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $this->getReturnUrl(),
            'notifyUrl' => $this->getNotifyUrl(),
            'requestType' => 'captureMoMoWallet',
            'signature' => hash_hmac('sha256', $string, $this->getSecretKey()),
            'extraData' => '',
        ];


        $res = Http::post($this->getEndpoint(), $data);

        return response()->json(json_decode($res->body(), true));
    }
}
