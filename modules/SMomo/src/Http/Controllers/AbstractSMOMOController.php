<?php


namespace SMOMO\Http\Controllers;


use MService\Payment\Shared\SharedModels\Environment;
use MService\Payment\Shared\SharedModels\PartnerInfo;

abstract class AbstractSMOMOController
{
    protected $endpoint;
    protected $accessKey;
    protected $partnerCode;
    protected $secretKey;
    protected $target;
    protected $env;
    protected $notifyUrl;
    protected $returnUrl;

    public function __construct()
    {
        $this->setEndpoint(config('momo.endpoint'));
        $this->setAccessKey(config('momo.access-key'));
        $this->setPartnerCode(config('momo.partner-code'));
        $this->setSecretKey(config('momo.secret-key'));
        $this->setTarget(config('momo.target'));

        $this->setNotifyUrl(route('api.momo.ipn'));
        $this->setReturnUrl(route('api.momo.ipn'));

        $this->setEnv($this->getEndpoint(), $this->getAccessKey(),
            $this->getPartnerCode(), $this->getSecretKey(), $this->getTarget());
    }

    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    public function setEnv($endpoint, $accessKey = null, $partnerCode = null, $secretKey = null, $target = null)
    {
        $accessKey = $accessKey ? : $this->getAccessKey();
        $partnerCode = $partnerCode ?: $this->getPartnerCode();
        $secretKey = $secretKey ?: $this->getSecretKey();
        $target = $target ?: $this->getTarget();

        $this->env = new Environment($endpoint, new PartnerInfo($accessKey, $partnerCode, $secretKey), $target);
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getAccessKey()
    {
        return $this->accessKey;
    }

    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
    }


    public function getPartnerCode()
    {
        return $this->partnerCode;
    }

    public function setPartnerCode($partnerCode)
    {
        $this->partnerCode = $partnerCode;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }
}
