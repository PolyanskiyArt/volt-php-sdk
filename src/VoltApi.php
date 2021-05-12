<?php

namespace LJJackson\Volt;

use LJJackson\Volt\Services\AuthenticationService;
use LJJackson\Volt\Services\BankService;
use LJJackson\Volt\Services\PaymentService;

class VoltApi
{
    private VoltApiConfig $config;
    public AuthenticationService $authentication;
    public PaymentService $payment;
    public BankService $banks;

    public function __construct(VoltApiConfig $config)
    {
        $this->config = $config;
        $this->authentication = new AuthenticationService($this);
        $this->payment = new PaymentService($this);
        $this->banks = new BankService($this);
    }

    public function getConfig(): VoltApiConfig
    {
        return $this->config;
    }
}