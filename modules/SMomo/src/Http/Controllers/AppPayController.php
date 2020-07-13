<?php


namespace SMOMO\Http\Controllers;

use Illuminate\Support\Facades\Http;
use MService\Payment\Pay\Processors\AppPay;
use MService\Payment\Shared\Utils\Encoder;


class AppPayController extends AbstractSMOMOController
{
    protected $endpoint = "https://test-payment.momo.vn/pay/app";

    public function index()
    {
        $amount = 200000;
        $appData = 'v2/lp5ktyePWW7v+buOq0pbfzFsPgE8JFl6Yv2JTSxLMr49nbps9BYSMuCBpDGUE9KLHMD564RI0mM93OaC8/J6Txp1DyKN08RhZ1dopUVf9ENZp2Kgw1jHM9zjywWA7AwvPsZOLPCd7Dmay7gHIcvcx+Zzw9/ju5ULm/kW7a+dV4QQ3wd3b6utB6lSW/zHfyGh6laPNG29ee0RCQrjv0RZRCPk9VR6lbFRJm5OmiIcLxBumrKYdZiOWdLTgDRhcTqozBy4OG3giLeHzd+fELp1w8Rd4aN/tJz5qo8X1Fpz8fXF5hnEAb6fzPd+Qg7mHKUiJ7ttdiSqylEeEqS5pp2WzNuHBu+8KiZhgaB+GHTwpV1D/ahaonFVDdG66jdrKsZhgd8efSS+GnCzj0hGNgNGoROt6YeP3XEYkzVQwohg3L0VkH3EX39swjVmZy4X7mNsjCAoInagiKMKGaF6ntAtuCC67v82LkDPJ2uNLEP1caj1fSFB9ndxMwWAZ4HYRSIDaDN3dB/OiWL787dW3ogjp77Z1yOLiUyzHSFL8Z1oorj95x9DO3D1pdRHgNSg+wtmt5jXjfarKy/dRtBZFkSFgweJtEDkp+2C9TPHivtsVUKENOsTs10aYVFbPVJKtsKCwKgMm7EjoC468oEEf1NRcXZTy/2sfw6Wchr64D/ZjO/7VVzAYxVL2HQoD4yUSAZlskGJ/5Pgvw2fVcoISEgmVkQft4U6nnYAiBmVFN5g16mhGAxfGdPZ9FOysocXsL0MF4PmN1+ctk2e27zTFLbWv5yS2UIK6wjd6nYNoyQWa88=';
        $publicKey = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAuEHtbYBR0S8WtFmgHAFqoDaWJmj4jcp5H7nYNH4MPrTLj97LVw3+MSlE4AYBAjEeeh/BZO6tKhSBxdyOsjPoX2uFVQkNjymBl40FYs4rN8K7GInxUElME40E4Ed2nXQM3YzwSQYiR2+evsP2jTsMPv29cUIscWhovGptTvLNGX7MoPgaS/7D9R54fdzGXUFmQhiGjgq6McwWoRCxfq6lkKy6ZdXXqMTPeDMHAuPeiZG6gZtC+iZTZo088CyMA5jxIHJEtKkryEE0w5TJ+NVy3e7eLkmUEa18ZfeJbjJy+Tn2E+DTLX/Crg21dP/LmzqbrIaSAEqVu1/0EPNgzZfYr5Z2i6h8BTxvkVu+HfxlwpB/PZ7LsR4EcMwu+u/Wpz8buD/Uy8J2zvwr/mKsld3DaMhrYgV/D8UxcFZmWDlOGbkiY/UAPNldBf4NT6tNYVMW56f239Kbf38PkRNq5GWc8W4KCaL8zlFt+jqZKgevYayILq4dpVyK/47z0Mi7tRyRObOcHA9D8CIQ1lHnrDwHE3fHasjjTTZjJfYaOYdYHX572TWM+sgl9Xone9Eb7xBdt++jjs4CkhS/qClXjE4uRt9fpCxyBmpcP8s/XJOf57laJ2lyI51xnDvoGjP4bteW1V/9izherZEoq25p8ujCbaTDFU7BmP+QvFcIoHHCSvMCAwEAAQ==';
        $customerNumber = "0917030000";
        $partnerRefId = time()."MA_DON_HANG";

        $this->setEndpoint('https://test-payment.momo.vn/pay/app');
        $this->setEnv('https://test-payment.momo.vn/pay/app', 2424);

        $res = AppPay::process($this->getEnv(),
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
    }

    public function pay($amount)
    {
        $encryptData = [
            "partnerCode" => $this->getPartnerCode(),
            "partnerRefId" => "momoswgm20200616",
            "amount" => $amount,
//            "partnerName" => "",
            "partnerTransId" => time(),
//            "storeId" => "",
//            "storeName" => "",
        ];

        $publicKey = "";

        $data = [
            'partnerCode' => $this->getPartnerCode(),
            'partnerRefId' => 'momoswgm20200616',
            'customerNumber' => '0919100101',
            'appData' => request('appData'),
            'hash' => Encoder::encryptRSA($encryptData, $publicKey),
            'version' => 2,
            'payType' => 3,
            'description' => '',
            'extra_data' => ''
        ];

        $res = Http::post($this->getEndpoint(), $data);
    }
}
