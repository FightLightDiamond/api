<?php

namespace SMOMO\Http\Controllers;

use MService\Payment\AllInOne\Processors\PayATM;
use MService\Payment\Shared\SharedModels\Environment;
use MService\Payment\Shared\SharedModels\PartnerInfo;

class PayATMController extends AbstractSMOMOController
{
    public function index()
    {
        $requestId = time() . "";
        $orderId = (string)request('orderId');
        $orderInfo = request('orderInfo');;
        $amount = request('amount');
        $bankCode = request('bankCode');

        $extraData = "";

        $res = PayATM::process($this->getEnv(), $orderId, $orderInfo, $amount,
            $extraData, $requestId, $this->getNotifyUrl(), $this->getReturnUrl(), $bankCode);

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
    }
}
