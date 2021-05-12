<?php


namespace LJJackson\Volt\Entities;


class PaymentRequest
{
    protected string $id;
    private bool $production = true;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSandbox(): self
    {
        $this->production = false;

        return $this;
    }

    public function getCheckoutToken(): string
    {
        return base64_encode($this->getId());
    }

    public function getRedirectUri(): string
    {
        if ($this->production) {
            return "https://checkout.volt.io/{$this->getCheckoutToken()}";
        }

        return "https://checkout.sandbox.volt.io/{$this->getCheckoutToken()}";
    }
}